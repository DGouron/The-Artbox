<?php
/**
 * This script displays error messages passed through variables.
 * It should be included at the top of forms to show validation errors.
 * Expects an $error variable to be defined by the use case.
 */

if (isset($error) && !empty($error)): ?>
    <div class="error-message" style="background-color: #f8d7da; color: #721c24; padding: 15px; margin: 20px 0; border: 1px solid #f5c6cb; border-radius: 4px;">
       <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>
