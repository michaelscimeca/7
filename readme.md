# NormCore 2.0 - A basic Wordpress theme template

## Quick start (if already installed locally)
In your terminal cd into the directory and run the following commands:
- `nvm use`
- `npm i`
- activate theme on wordpress
- `npm run gulp-sync` ! (Before doing this go into gulp and change the proxy at the bottom of the gulp file to the correct local.project url)
- `npm run build` !


## Initial Setup
#### Requirements
  - [Download of the latest WP Core](https://wordpress.org/download/)
  - RDS database
  - S3 bucket
  - Plugins (minimum requirements)
    - WP Offload Media Lite for Amazon S3
    - ACF Pro
    - Yoast

#### Guide
1. [Setup a RDS database](https://github.com/RSQDevelopmentTeam/tech-guide/blob/master/aws/creating-rds-databases.md) and make note of the following to place in the `wp-config.php`:
	- database name
  	- username
  	- password
  	- host (`rds.redsquareagency.com`)
2. Place the WP Core download in a directory where you can run a server. (For example with docker, MAMP, or Local by Flywheel)
3. Copy the `red-wp-config.php` and `.gitignore` files included in this repo into the root of the WP Core / repo.
4. Add the database credentials to the `wp-config.php` file.
5. Change the theme folder name and update the references in the `.gitignore`.
6. Spin up your local server.
7. Install Wordpress
8. Install the required plugins
9. [Set up an S3 bucket](https://github.com/RSQDevelopmentTeam/tech-guide/blob/master/aws/creating-buckets.md) and make note of the following:
	- `access key id`
	- `access key secret`
	- `bucket-name`
10. Set up the `WP Offload Media Lite for Amazon S3` plugin.
 	- Select the option to save the `access key id` and `access key secret` in the database as there wont be anything secret in this database and those keys will only give them access to the very database they obviously already have gained access to.
	- Enter the `bucket-name`
	- All uploads will now be placed in the S3 bucket
11. Place this theme template in the theme folder and activate it.
12. START THE FUN!

### Deploying to Staging
*This guide is for deploying to a staging environment on Heroku*
#### Requirements
  - A Heroku App

#### Guide
1. Log into heroku
2. Create a new App
3. Navigate to the `Settings` page of the app
4. Click `Reveal Config Vars`
5. Enter the following key / value pairs (replace `app-name` with your app name)
	- `DOMAIN : https://app-name.herokuapp.com/`
	- `NODE_ENV : staging`
6. Click `Hide Config Vars`
7. Scroll down and make note of the `Heroku Git URL` for adding the remote repository later
8. In your terminal add the remote repo of the heroku app: (replace `app-name` with your app name)
```bash
$ git remote add staging https://git.heroku.com/app-name.git
```
9. Push to Staging
```bash
$ git push staging
```

### Use Browser-Sync
`npm run gulp-sync`

All of the `sass` files are compiled down to a singular css file named `style.css` located on the root of the theme.

All of the `js` is compiled down to a singular js file named `scripts.min.js` located in `library/js/build`.

Both of these files are enqueued onto the site via the `rsq-functions.php` file.

## Global Page Nav
*Applies to global menus and footer navs*

The user should be able to add and reorder navigation menus as they see fit.
Navigation should be customized in the Menus section of the Customize tab.
To pull in a menu place the following on any template.

*Ideally global navs should be place in the header.php and/or the footer.php template files*

```php
<?php
    // 'Main Nav' is the name of the menu created in the customize tab
    $args = array('menu' => 'Main Nav');
    wp_nav_menu($args);
?>
```
## Custom Post Types
There is a special function included in the `rsq-functions.php` file in the theme library, which can loop through an array to easily create Custom Post Types.
All you need to do in `functions.php` is add your post details to the `$postTypes` array.

### Required
`'name'` `'singular'` `'slug'`

### Optional
`'desc'` `'position'` `'public'` `'show_ui'` `'show_in_rest'` `'has_archive'` `'show_in_menu'` `'exclude_from_search'` `'capability_type'` `'map_meta_cap'` `'hierarchical'` `'query_var'`


```
<?php
$postTypes = array(
    array(
        'name' => 'Movies', //required
        'singular' => 'Movie', //required
        'slug' => 'movies' //required
    ),
    array(
        'name' => 'Employees', //required
        'singular' => 'Employee', //required
        'slug' => 'employees', //required
        'desc' => 'Description of this post type.', //optional
        'position' => 5 //optional
    )
);
?>
```

When creating a new post type ensure that there are `single-{slug}.php` and `archive-{slug}.php` template files for each new post type.

*Note: after creating a new post type make sure to flush the permalinks, but going to the Permalinks panel in the admin and resaving the existing settings.*

## Sub Templates
The `template-parts` folder contains the templates for specific content types or post formats. You will notice that these templates are used inside any of the content loops on the site.

```
<?php
    //Will use the `content-page.php` template for any of the content rendered from the loop.
    get_template_part( 'template-parts/content', 'page' );
?>
```


```
<?php
    //Will use the post format designated on a post to dictate which template will be used.
    get_template_part( 'template-parts/content', get_post_format() );
?>
```


## Post Formats
There might be a situation where you will need a different layout based on the type of content within a post. This is where post formats can be helpful. To activate a post format, uncomment the needed format in `functions.php`.
```
<?php
    add_theme_support( 'post-formats', array(
    // 	'aside',
    	'image',
    // 	'video',
    // 	'quote',
    // 	'link',
    // 	'gallery',
    // 	'status',
    // 	'audio',
    // 	'chat',
    ) );
?>
```
To ensure that posts with custom formats use the templates you created for them use
```
<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
```
in your loops.

These templates should be placed in the `template-parts` folder and named like so `content-{format}.php`. For example a post format of `image` will use the `content-image.php` template.

## Page Templates
To create a custom template for a Page all you need to do is create a new page template file following this naming convention: `page_{template-name}.php`

In the comment header of the template include:

```
<?php
    /* Template Name: About page */
?>
```

`About page` will be what shows up in the Template drop down on the Page editor.

## Plugins
The base plugins we use are:
- Advanced Custom Fields Pro
- Yoast SEO

## Styling the Login
Custom styles for the login page are located at `library/admin-style/admin-login.scss`. This file compiles down to `admin-login.css` located on the root.

The stylesheet is used only on the login page. This is executed in `library/functions/normcore-admin-style-login.php`.

Any images referenced in the stylesheet should be placed in `library/img`.

## Custom Excerpts ( Frontend )

### `normcore_excerpt()` function
Located: `/library/functions/normcore-custom-excerpt.php`

### Parameters
##### Required
`'amount'` `'callback'`

The `normcore_excerpt()` function takes two arguments `amount` & `callback`.

Below is a example of  `normcore_excerpt()` function with two functions as arguments.
```
<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
        // Teaser post
	    normcore_excerpt('normcore_amount','normcore_more_view');
	endwhile;
else :
	echo '<p>No Page Found</p>';
endif;
?>
```
 The two arguments can look like this.
```
<?php
/* === Custom Length === */
function normcore_amount() {
	return 20;
}

/* === Custom Text === */
function normcore_more_view() {
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . 'Read More' . '</a>';
}
?>
```
## Add Link to Admin Toolbar ( Backend )
Located: `/library/functions/normcore-admin-bar.php`

Using the `Global $wp_admin_bar` object methods `add_menu()` & `remove_menu()`. We can manipulate the Toolbar to add and remove links.
Within the `normcore_add_admin_bar()` & `normcore_remove_admin_bar()` functions lies examples.

#### `add_menu()` function

### Parameters
##### Required
`'id'`

##### Optional
`'title'` `'parent'` `'href'` `'group'` `'meta'`

Below is an example of adding a custom logo by injecting the image tag to the `'title'` key .

```
<?php
function normcore_add_admin_bar() {
	global $wp_admin_bar;
	/* === Add custom logo to Toolbar  === */
	$wp_admin_bar->add_menu( array(
		'id'    => 'logo',
		'title' => '<img style="height:20px; width:20px; top:6px; position:relative; padding-right:10px;" src="' . get_template_directory_uri() . '/images/bnl-logo.jpg"/>' . get_bloginfo('name'),
		'href'  => admin_url()
	));
}

add_action('wp_before_admin_bar_render', 'normcore_remove_admin_bar', 0);
?>
```
## Remove Link from Admin Toolbar ( Backend )
Located: `/library/functions/normcore-admin-bar.php`
#### `remove_menu()` function

### Parameters
##### Required
`'id'`

Below is an example of removing all the defualt links in the Toolbar.
```
<?php
function normcore_remove_admin_bar() {
    global $wp_admin_bar;
    $arg = array(
        'new-content',
        'wp-logo',
        'comments',
        'view',
        'site-name',
        'updates'
    );

    foreach($arg as $value){
        $wp_admin_bar->remove_menu( $value );
    }
}

add_action('wp_before_admin_bar_render', 'normcore_remove_admin_bar', 0);
?>
```

## Add Admin Menu Page ( Backend )
#### `add_menu_page()` function
Located: `/library/functions/normcore-admin-menu.php`

### Parameters
##### Required
`'page_title'` `'menu_title'`

##### Optional
`'capability'` `'menu_slug'` `'function'` `'icon_url'` `'position'`

The example below illustrates how to register a Movie link to the Admin Menu page using `add_menu_page()` function.
```
<?php
function normcore_add_menu_page(){
    add_menu_page(
        'Movie',
        'Movie',
        'manage_options',
        'post.php?post=812&action=edit',
        '',
        'movie-icon.png',
        5
    );
}

add_action( 'admin_menu', 'normcore_add_menu_page' );
?>
```
## Remove Admin Menu Page ( Backend )
#### `remove_menu_page()` function
Located: `/library/functions/normcore-admin-menu.php`

### Parameters
##### Required
`'menu_slug'`

##### Return Values
`The removed menu on success, false if not found.`

By harnessing the `remove_menu_page()` funciton you can clean up the Admin Menu Sidebar.

To find the right `$menu_slug` to add to the `remove_menu_page()` function. You can echo the code below and look for the second element `'[2]'` in the array that your targeting.
```
<?php
echo '<pre style="background-color: #1c94da;z-index: 22222222222;top: 0px;left: 0px; position: absolute; color: white; margin: 0px">' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
?>
```
The example below removes all defualt links.
```
<?php
function normcore_remove_menu_page() {
    $arg = array(
        'index.php',
        'edit.php?post_type=page',
        'edit.php',
        'upload.php',
        'edit-comments.php',
        'themes.php',
        'users.php',
        'tools.php',
        'options-general.php',
        'plugins.php',
        'edit.php?post_type=acf-field-group',
        'cptui_main_menu',
    );

    foreach ($arg as $value) {
        remove_menu_page( $value );
    }
}

add_action( 'admin_menu', 'normcore_remove_menu_page' );
?>
```
Note: *This `normcore_remove_menu_page()` function should be called on the `admin_menu` action hook.*

## Sort Admin Menu
#### `normcore_sort_menu_page()` function
Located: `/library/functions/normcore-admin-menu.php`

By using `normcore_sort_menu_page()` function you can sort the Admin Menu. Simple add the links in the order you desire.

In the example below. The Admin Menu would result in the following order
| Dasboard |
| Movies   |
| News     |
| Story    |

```
<?php
function normcore_sort_menu_page($menu_ord) {
    if (!$menu_ord) return true;
        return array(
            'index.php', //Dashboard link
            'edit.php?post_type=movie', // Movie
            'edit.php?post_type=news',  // News
            'edit.php?post_type=story', // Story
            'edit.php', // Default
        );
}

add_filter('custom_menu_order', 'normcore_sort_menu_page');
add_filter('menu_order', 'normcore_sort_menu_page');
?>
```
This `custom_menu_order` hook activates the `'menu_order'` filter. Return true in order to activate the `'menu_order'` filter.

This `menu_order` hook adds the ability to reorder top-level menus.

## Styling the Admin Menu

The example below illitrates a easy way to add customization to the admin page. Keep in mind this is a small example a
```
<?php
function normcore_admin_menu_style() {
   echo '<style type="text/css"> .wp-menu-separator {display: none;} </style>';
}

add_action( 'admin_head', 'normcore_admin_menu_style' );
?>
```

## Add Dashboard Widgets ( Backend )

#### `wp_add_dashboard_widget()` function
Located: `/library/functions/normcore-admin-widgets.php`

### Parameters
##### Required
`'widget_id'` `'widget_name'`

##### Optional
`'callback'` `'control_callback'` `'callback_args'`

The `wp_add_dashboard_widget()` function adds a new widget to the Admin Dashbaord. [Using the WordPress Dashboard Widgets API.](API.https://codex.wordpress.org/Dashboard_Widgets_API)

The example below adds a widget.
```
<?php
function normcore_add_widgets() {
   wp_add_dashboard_widget( 'dashboard_widget', 'TEST', 'normcore_dashboard_widget_function' );
}

function normcore_dashboard_widget_function() {
   echo '<div class="admin">TEST</div>';
}

add_action('wp_dashboard_setup', 'normcore_add_widgets');
?>
```

## remove Dashboard Widgets ( Backend )
#### `remove_meta_box()` function
Located: `/library/functions/normcore-admin-widgets.php`

### Parameters
##### Required
`'id'` `'page'` `'context'`

The `remove_meta_box()` function allows you to remove widgets from your Admin Dashbaord.

The example below removes all the defualt widgets.
```
<?php
function normcore_remove_widget_box() {
    remove_meta_box( 'dashboard_activity',    'dashboard', 'normal' );      // Activity
    remove_meta_box( 'dashboard_primary',     'dashboard', 'side' );        // WordPress News
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );        // Quick Draft
    remove_meta_box( 'dashboard_right_now',   'dashboard', 'normal' );      // At a Glance
}

add_action('wp_dashboard_setup', 'normcore_remove_widget_box');
?>
```
## Adds Custom Post Types to search results ( Frontend )
The example shows you how to add your custom post types to the search results via the `$query object`.

```
<?php
function normcore_search_all( $query ) {
    if ( $query->is_search ) {
        $query->set(
            'post_type',
             array(
                'site',
                'plugin',
                'theme',
                'person'
            )
        );
    }
    return $query;
}

add_action( 'pre_get_posts', 'normcore_search_all' );
?>
```
The `pre_get_posts` hook gives developers access to the $query object by reference (any changes you make to $query are made directly to the original object - no return value is necessary).
