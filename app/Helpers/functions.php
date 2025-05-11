<?php

if (!function_exists('getCategoryIcon')) {
    /**
     * Get an icon name for a job category
     *
     * @param string $category The job category
     * @return string The icon name
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
            'Customer Service' => 'headset',
            'Human Resources' => 'users',
            'Finance' => 'dollar-sign',
            'Business' => 'briefcase',
            'Quality Assurance' => 'check-circle',
            'DevOps' => 'server',
            'IT & Networking' => 'network-wired',
            'Security' => 'shield-alt',
            'Content Creation' => 'pen-fancy',
            'Healthcare' => 'heartbeat',
            'Education' => 'graduation-cap',
            'Engineering' => 'cogs',
            'Technology' => 'laptop-code',
            'Retail' => 'shopping-cart',
            'Manufacturing' => 'industry',
            'Hospitality' => 'hotel',
            'Construction' => 'hard-hat',
            'Transportation' => 'truck',
            'Media' => 'photo-video',
            'Agriculture' => 'leaf'
        ];

        return $icons[$category] ?? 'briefcase';
    }
}

if (!function_exists('getIndustryIcon')) {
    /**
     * Get an icon name for an industry
     *
     * @param string $industry The industry name
     * @return string The icon name
     */
    function getIndustryIcon($industry)
    {
        $icons = [
            'Technology' => 'laptop-code',
            'Healthcare' => 'heartbeat',
            'Finance' => 'chart-line',
            'Education' => 'graduation-cap',
            'Retail' => 'shopping-cart',
            'Manufacturing' => 'industry',
            'Marketing' => 'bullhorn',
            'Hospitality' => 'hotel',
            'Construction' => 'hard-hat',
            'Transportation' => 'truck',
            'Media' => 'photo-video',
            'Agriculture' => 'leaf'
        ];

        return $icons[$industry] ?? 'building';
    }
}
