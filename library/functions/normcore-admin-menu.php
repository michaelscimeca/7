<?php
/***************************************************************
* Adding Pages to Admin Sidebar Menu
****************************************************************/

/* === Adds page links with icons to the Admin Sidebar Menu . === */
function normcore_add_menu_page(){
    add_menu_page(
        'Wewe', // The text to be displayed in the title tags of the page when the menu is selected.
        'Wewe', // The text to be used for the menu.
        'edit_pages', // The capability required for this menu to be displayed to the user.
        'post.php?post=812&action=edit', // The slug name to refer to this menu by (should be unique for this menu).
        '', // The function to be called to output the content for this page.
        'image.png', // The URL to the icon to be used for this menu.
        5 // The position in the menu order this one should appear.  5 - 100
    );
}

// add_action( 'admin_menu', 'normcore_add_menu_page' );

/***************************************************************
* Remove Pages from Admin Menu
****************************************************************/

/* === Remove page links from Admin Sidebar Menu. === */
function normcore_remove_menu_page() {
    $arg = array(
        // 'index.php',
        // 'edit.php?post_type=page',
        // 'edit.php',
        // 'upload.php',
        'edit-comments.php',
        // 'themes.php',
        // 'users.php',
        'tools.php',
        // 'options-general.php',
        // 'plugins.php',
        // 'edit.php?post_type=acf-field-group',
        // 'cptui_main_menu'
    );

    foreach ($arg as $value) {
        remove_menu_page( $value );
    }

    /* ===
    * Uncommenting the echo below. Will display the admin menu array.
    * Using this array list find the [2] string and apply it to the remove_menu_page( '[2]') function.
    * Below is an example.

    [100] => Array (
        [0] => CPT UI
        [1] => manage_options
    *** [2] => cptui_main_menu ***
        [3] => Custom Post Types
        [4] => menu-top toplevel_page_cptui_main_menu
        [5] => toplevel_page_cptui_main_menu
        [6] => data:image/svg;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABC9pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDE0IDc5LjE1Njc5NywgMjAxNC8wOC8yMC0wOTo1MzowMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wUmlnaHRzOk1hcmtlZD0iVHJ1ZSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo5NkE3NTc5MUJCOTIxMUU0QUVENDlFMUYwOEMyRDgwQyIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo5NkE3NTc5MEJCOTIxMUU0QUVENDlFMUYwOEMyRDgwQyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNCAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmRpZDo5NjMzOTU2ODgyMjhFMDExOTg5Q0MwQTFBRDAyQjVDMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5NjMzOTU2ODgyMjhFMDExOTg5Q0MwQTFBRDAyQjVDMiIvPiA8ZGM6cmlnaHRzPiA8cmRmOkFsdD4gPHJkZjpsaSB4bWw6bGFuZz0ieC1kZWZhdWx0Ij5DcmVhdGl2ZSBDb21tb25zIEF0dHJpYnV0aW9uIE5vbi1Db21tZXJjaWFsIE5vIERlcml2YXRpdmVzPC9yZGY6bGk+IDwvcmRmOkFsdD4gPC9kYzpyaWdodHM+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+hXhu9wAAAjdJREFUeNrcWYFtwjAQBNQB0g3oBukEDRPUnYCwQRmhE8AGhgnKBh0h2YBuQDZIbclI6GXH7/c7cfrSCxEcuHv+7x3/su/7xZxttZi5/XsChfJP5Y3ynskFKwNdAw4Xym89r9UDv0dy1wd1z2/s4F0ERGbgC+WN8iuGQJFZ2tzB303ANbCIa1O4XLZTfiLeq3H8KC8frr3BRU/g/dbzpRflZ+Wd8ta8pjAbeG2VT4VGL0JE2kArXClUeCJ/GqEvuSL/aGtKJz5nAv5oUtdKYCifuwzAa+Bf8OIS7EZdW9PnCQoWBnADox+SQhjwtQcEFby2vQ18iAr5lEOadboJlkxqczcZspWgEJBgLYYEFnwDZZObgHSsHyKBBY/6N2MISEL0sODRjZNK4IAEocGuzT1lAHiJ7dxYGV0CtZEJe0JrJBMl2xQCN+YdK0rvHSYoD/WXhNHfB4DXmfBNrQGZ4KlNBuxYaxcwThUKsYYCPpZAiCT69H5NAR9LgIuEoILnIBBL4hCQOlajyGjMrhLq/WvIGVzKs9FQ/dbrP3I73A0hoY9bfnM8ncaQOHI2Q64awNZEaN6PVgOYf4It78cacEASG668HyOFUlhUClUTg69iU6hYZGpYAtuJcb5jZ2Q5nE5DL4eGLrCIG89+Zqz5QPUQ+aGhSwsJ6JHqYUZj4j0koJlecy5a0GdeVpaLu5lEX+PsVo48380A/MWmQqkn9RzPz2LoZM7WwGrTB8oJI94a9TtB5fsTYABOp6Z0XZr87gAAAABJRU5ErkJggg==
    )
    === */

    // echo '<pre style="background-color: #1c94da; z-index: 22222222222; top: 0px; left: 0px; position: absolute; color: white; margin: 0px">'. print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';

}



/* === Fires before the administration menu loads in the admin. === */
add_action( 'admin_menu', 'normcore_remove_menu_page' );

/***************************************************************
*  Sort Pages in Admin Menu
****************************************************************/

/* === Reorder the Admin Sidebar Menu links === */
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

// add_filter('custom_menu_order', 'normcore_sort_menu_page');
// add_filter('menu_order', 'normcore_sort_menu_page');

/***************************************************************
* Admin Menu Css styling.
****************************************************************/

/* === Adds a css style to the admin header. Which just removes a spacing right before "Plugin" link in the Admin Menu Sidebar === */
function normcore_admin_menu_style() {
   echo '<style type="text/css"> .wp-menu-separator {display: none;} </style>';
}


/* === admin_head is an hook that allows you to add stuff in the admin header. === */
// add_action( 'admin_head', 'normcore_admin_menu_style' );
?>
