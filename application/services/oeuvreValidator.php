<?php

/**
 * This class is responsible for validating and sanitizing the data submitted via the artwork submission form.
 */
class OeuvreValidator
{
    /**
     * Sanitizes the input data by removing any extra spaces.
     *
     * @param array $data The raw data to sanitize.
     * @return array The sanitized data.
     */
    public function sanitizeInput(array $data): array
    {
        return [
            'titre' => trim($data['titre'] ?? ''),
            'artiste' => trim($data['artiste'] ?? ''),
            'image' => trim($data['image'] ?? ''),
            'description' => trim($data['description'] ?? '')
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
     *
     * @param string $url The URL to validate.
     * @throws InvalidArgumentException If the URL is not valid.
     */
    public function validateImageUrl(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("Erreur : L'URL de l'image n'est pas valide.");
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

        return $cleanData;
    }
}
