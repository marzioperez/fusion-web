import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    safelist: [
        'pt-0', 'pt-1', 'pt-2', 'pt-3', 'pt-4', 'pt-5', 'pt-6', 'pt-7', 'pt-8', 'pt-9', 'pt-10', 'pt-11', 'pt-12', 'pt-14', 'pt-16', 'pt-20', 'pt-24',
        'pb-0', 'pb-1', 'pb-2', 'pb-3', 'pb-4', 'pb-5', 'pb-6', 'pb-7', 'pb-8', 'pb-9', 'pb-10', 'pb-11', 'pb-12', 'pb-14', 'pb-16', 'pb-20', 'pb-24',
        'md:pt-0', 'md:pt-1', 'md:pt-2', 'md:pt-3', 'md:pt-4', 'md:pt-5', 'md:pt-6', 'md:pt-7', 'md:pt-8', 'md:pt-9', 'md:pt-10', 'md:pt-12', 'md:pt-14', 'md:pt-16', 'md:pt-20', 'md:pt-24',
        'md:pb-0', 'md:pb-1', 'md:pb-2', 'md:pb-3', 'md:pb-4', 'md:pb-5', 'md:pb-6', 'md:pb-7', 'md:pb-8', 'md:pb-9', 'md:pb-10', 'md:pb-12', 'md:pb-14', 'md:pb-16', 'md:pb-20', 'md:pb-24',
        'xl:text-7xl', 'xl:text-6xl', 'xl:text-5xl', 'xl:text-4xl',
        'lg:text-7xl', 'lg:text-6xl', 'lg:text-5xl', 'lg:text-4xl',
        'md:text-7xl', 'md:text-6xl', 'md:text-5xl', 'md:text-4xl',
    ],
    theme: {},
    plugins: [],
};
