<?php

if (!function_exists('getCategoryIcon')) {
    /**
     * Get the Font Awesome icon for a job category
     *
     * @param string $category
     * @return string
     */
    function getCategoryIcon($category)
    {
        $icons = [
            'Web Development' => 'code',
            'Mobile Development' => 'mobile-alt',
            'Data Science' => 'chart-bar',
            'Design' => 'paint-brush',
            'Product Management' => 'tasks',
            'Marketing' => 'bullhorn',
            'Sales' => 'handshake',
            'Customer Support' => 'headset',
            'Human Resources' => 'users',
            'Finance' => 'dollar-sign',
            'Business' => 'briefcase',
            'Quality Assurance' => 'check-circle',
            'DevOps' => 'server',
            'IT & Networking' => 'network-wired',
            'Security' => 'shield-alt',
            'Content Creation' => 'pen-fancy',
        ];

        // Return the icon for the category, or a default icon if not found
        return $icons[$category] ?? 'briefcase';
    }
}
