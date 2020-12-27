# Cream

![](https://www.subgression.com/tests/cream_rmplasticdisplay/cream/img/cream_icon.png)

![](https://img.shields.io/github/stars/subgression/Cream.svg) ![](https://img.shields.io/github/forks/subgression/Cream.svg) ![](https://img.shields.io/github/tag/subgression/Cream.svg) ![](https://img.shields.io/github/issues/subgression/Cream.svg)


**Table of Contents**

[TOCM]

# Features
- Server side rendering of text and image sources
- <b> Toppings! (WIP) </b> Allow developers to specify react-like components, and rendering them server side, as fast as possible, and allowing user to edit all the content of one (or multiple) toppings.
- <b> SEO Tool (WIP) </b> Analyze and scan pages to find errors in SEO configuration, reach millions of users!
- <b> Image Compressor (WIP) </b> Auto compress images and video to the correct format
- Compatible with all major browsers, inclusing mobile!

# Why Cream?
When doing a project, most of the work is editing small part of content, such as texts and images, simple stuff that even customer can edit, if provided with a simple enough interface, so why not creating that from scratch?

# How To Use
Cream is created to be as simple as possible, no unnecessary and complex backend to handle content!
Each page that use the Cream needs the following requirements:
```php
<?php require "./cream/src/Cream.class.php"; ?>
```
## Text
Simply replace any of the tag you need to allow edit from:
```html
<p> Foo </p>
```
to:
```php
<p data-cream-type="text" data-cream-name="your-id"> $Cream->Text("your_id", "Foo"); </p>`
```
## Image
Same as text! Replace:
```html
<img src="your_src" />
```
with:
```php
<img data-cream-type="image" data-cream-name="your-id" src=<?php $Cream->Image("your_id", "your_src"); ?> />
```
# Changelog
## V0.1.0
- Initial commit
- Somewhat functioning cream basic script
## V0.2.0
- Updated UI
- Better frontend managmente using functions
- Bugfixing and performance improvements
## V0.2.1
- Added a function to reset content to defaults
## V0.2.2
- Added a really poor login system (@todo: Make a new one, avoiding sending password in clear)
## V0.2.3
- Added config.json, where the user can config paths to image folders
- Created Video Gallery Section
- Added an Image Upload Section
## V0.2.4
- Added a new image selector
- Extended Cream API
