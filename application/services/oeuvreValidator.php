<?php

/**
 * This class is responsible for validating and sanitizing the data submitted via the artwork submission form.
 */
class OeuvreValidator
{
    /**
     * Sanitizes the input data by removing any extra spaces and protecting against XSS.
     *
     * @param array $data The raw data to sanitize.
     * @return array The sanitized data.
     */
    public function sanitizeInput(array $data): array
    {
        return [
            'titre' => htmlspecialchars(trim($data['titre'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'artiste' => htmlspecialchars(trim($data['artiste'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'image' => htmlspecialchars(trim($data['image'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'description' => htmlspecialchars(trim($data['description'] ?? ''), ENT_QUOTES, 'UTF-8')
        ];
    }

    /**
     * Checks that all required fields are present and not empty.
     *
     * @param array $data The data to validate.
     * @param array $requiredFields The required fields.
     * @throws InvalidArgumentException If a required field is empty.
     */
    public function validateRequired(array $data, array $requiredFields): void
    {
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new InvalidArgumentException("Erreur : Tous les champs sont obligatoires.");
            }
        }
    }

    /**
     * Validates the format of the image URL.
     * The URL must start with https://.
     *
     * @param string $url The URL to validate.
     * @throws InvalidArgumentException If the URL is not valid or doesn't use HTTPS.
     */
    public function validateImageUrl(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("Erreur : L'URL de l'image n'est pas valide.");
        }

        if (!str_starts_with(strtolower($url), 'https://')) {
            throw new InvalidArgumentException("Erreur : L'URL de l'image doit commencer par https://");
        }
    }

    /**
     * Validates that the description has at least 3 characters.
     *
     * @param string $description The description to validate.
     * @throws InvalidArgumentException If the description is too short.
     */
    public function validateDescription(string $description): void
    {
        if (strlen($description) < 3) {
            throw new InvalidArgumentException("Erreur : La description doit contenir au moins 3 caractères.");
        }
    }

    /**
    * Validates and sanitizes the data of an artwork.
     *
     * This method orchestrates all necessary validations.
     *
     * @param array $data The raw data to validate.
     * @return array The validated and sanitized data.
     * @throws InvalidArgumentException If the data is not valid.
     */
    public function validate(array $data): array
    {
        $cleanData = $this->sanitizeInput($data);

        $requiredFields = ['titre', 'artiste', 'image', 'description'];
        $this->validateRequired($cleanData, $requiredFields);

        $this->validateImageUrl($cleanData['image']);
        $this->validateDescription($cleanData['description']);

        return $cleanData;
    }
}
