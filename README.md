# README

Thank you for purchasing Global Report!

If you have any questions that are beyond the scope of this help file, please feel free to email me at [mitchellhillman@gmail.com](mailto:mitchellhillman@gmail.com).

Global Report is a web app style Wordpress theme for Magazines and Blogs. It is inspired by other news magazines such as Quartz, Time Magazine and TNW. It features:

- Infinite page loading that rewrites the URL as you scroll.
- Persistant sidebar of news
- Easily customize site logo and brand colors
- Advertising widget area that fits ads of any size
- Responsive and mobile friendly
- Complete retina support

_This theme has very specific set of features and challenges and as such may not support 'typical' plugins. This theme does not suport commenting on posts._

## Layout

This theme is responsive between to set layouts. The desktop, or wide tablet view has a persistent sidebar and main content area.

The sidebar loads a list of all posts. It loads the first 10 ten posts and then loads 10 at a time by clicking the "more" button at the bottom of the sidebar. 

The main content area loads a new article when the user scrolls to the bottom of the page.

On smaller screens the sidebar is full width, with the main content hidden on the home page. On subsequent pages, the sidebar is hidden and the content is shown.

## CSS Structure

This theme is built using SASS and Compass and compiled to the default wordpress style.css file. Use [Codekit](https://incident57.com/codekit/) or another SASS compiler to make changes. 

### SASS File Structure

The SASS files are broken up according to function and compiled together in the style.css file. Styles use the Compass reset

**_base.scss** *Site variables, fonts and utility mixins. Edit the unioversal theme font here.*

**_main.scss** *All the layout and module styles for the site*

**_responsive.scss** *All mdeia queries here. Uses both min-width and max-width media queries to provide gracefull degradation for browsers that do not support felx box*

### Scrolling and Flexbox

The responsive scrolling layout of this site depends on CSS3 flexbox and fixed height on the header. To change the header size, alter the *$header_height* variable in the **_main.scss** file. 

## Javascript

This theme is intended for browsers that hav javascript, but it will still be functional at a base level without it. Inifinite scroll, loading more sidebar articles and many other features are impossible without Javascript because they depend on AJAX.

AJAX functions take advantage of PHP wordpress functions and for that reason funtions that use them are written inline in **footer.php**. 

All javascript events and interactions are in **scripts.js**.

