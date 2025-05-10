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
            'Marketing' => 'bullhorn',
            'Sales' => 'dollar-sign',
            'Customer Service' => 'headset',
            'Finance' => 'chart-line',
            'Healthcare' => 'heartbeat',
            'Education' => 'graduation-cap',
            'Engineering' => 'cogs',
            'Human Resources' => 'users',
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
