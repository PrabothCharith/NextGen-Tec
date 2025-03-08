# Tailwind CSS
Tailwind CSS is a utility-first CSS framework for rapidly building custom designs. It is a highly customizable, low-level CSS framework that gives you all of the building blocks you need to build bespoke designs without any annoying opinionated styles you have to fight to override.

## Table of Contents
- [Tailwind CSS](#tailwind-css)
  - [Table of Contents](#table-of-contents)
  - [1. Installation](#1-installation)
    - [1.1 Via CDN](#11-via-cdn)
    - [1.2 Via npm](#12-via-npm)
      - [1. Install Tailwind CSS using npm:](#1-install-tailwind-css-using-npm)
      - [2. Import Tailwind in your CSS](#2-import-tailwind-in-your-css)
      - [3. Start the Tailwind CLI build process](#3-start-the-tailwind-cli-build-process)
  - [2. Usage](#2-usage)
    - [2.1 Example](#21-example)
  - [3. Customization](#3-customization)
    - [3.1 Configuration](#31-configuration)
  - [4. Responsive Design](#4-responsive-design)
    - [4.1 Example](#41-example)

## 1. Installation
You can install Tailwind CSS via npm or by including it in your HTML file.

### 1.1 Via CDN
Add the following link to your HTML file:
```html
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
```

### 1.2 Via npm

#### 1. Install Tailwind CSS using npm:
```bash
npm install tailwindcss @tailwindcss/cli
```

#### 2. Import Tailwind in your CSS
```css
@import "tailwindcss";
```

OR If you're using old versions of Tailwind CSS.
```css
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';
```

#### 3. Start the Tailwind CLI build process
```bash
npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch
```
_This will watch the input.css file for changes and output the compiled CSS to output.css._

<br>

## 2. Usage
You can use Tailwind CSS classes directly in your HTML file to style elements.

### 2.1 Example
```html
<div class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
  Tailwind CSS
</div>
```
_This will create a blue background with white text, bold font, padding, and rounded corners._

<br>

## 3. Customization
Tailwind CSS is highly customizable. You can configure the framework to include only the styles you need, which helps reduce the final CSS file size.

### 3.1 Configuration
You can customize Tailwind CSS by creating a `tailwind.config.js` file in your project and modifying the default configuration.

<br>

## 4. Responsive Design
Tailwind CSS includes utilities for building responsive designs. You can use classes like `sm:`, `md:`, `lg:`, and `xl:` to apply styles based on screen sizes.

### 4.1 Example
```html
<div class="bg-blue-500 text-white font-bold py-2 px-4 rounded sm:bg-red-500 md:bg-green-500 lg:bg-yellow-500 xl:bg-purple-500">
  Responsive Design
</div>
```

_This will change the background color based on the screen size._