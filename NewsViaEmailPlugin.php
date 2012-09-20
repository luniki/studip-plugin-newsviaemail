<?php

# Copyright (c)  2012 - <mlunzena@uos.de>
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE.


class NewsViaEmailPlugin extends StudipPlugin implements SystemPlugin, StandardPlugin
{

    function __construct()
    {
        parent::__construct();
        NotificationCenter::addObserver($this, 'onNewsDidCreate', 'NewsDidCreate');
    }

    function onNewsDidCreate($nid)
    {
        $news = new StudipNews($id);

        $course_news = array_filter($news->getRanges(), function ($range) {
                return get_object_type($range, array('sem'));
            });

        foreach ($course_news as $course_id) {
            # find students
            # send messages
        }
    }

    /**
     * Return a template (an instance of the Flexi_Template class)
     * to be rendered on the course summary page. Return NULL to
     * render nothing for this plugin.
     *
     * The template will automatically get a standard layout, which
     * can be configured via attributes set on the template:
     *
     *  title        title to display, defaults to plugin name
     *  icon_url     icon for this plugin (if any)
     *  admin_url    admin link for this plugin (if any)
     *  admin_title  title for admin link (default: Administration)
     *
     * @return object   template object to render or NULL
     */
    function getInfoTemplate($course_id)
    {
        return NULL;
    }

    /**
     * Return a navigation object representing this plugin in the
     * course overview table or return NULL if you want to display
     * no icon for this plugin (or course). The navigation object's
     * title will not be shown, only the image (and its associated
     * attributes like 'title') and the URL are actually used.
     *
     * By convention, new or changed plugin content is indicated
     * by a different icon and a corresponding tooltip.
     *
     * @param  string   $course_id   course or institute range id
     * @param  int      $last_visit  time of user's last visit
     * @param  string   $user_id     the user to get the navigation for
     *
     * @return object   navigation item to render or NULL
     */
    function getIconNavigation($course_id, $last_visit, $user_id)
    {
        return NULL;
    }

    function getTabNavigation($course_id)
    {
        return NULL;
    }

    /**
     * return a list of ContentElement-objects, conatinging
     * everything new in this module
     *
     * @param  string   $course_id   the course-id to get the new stuff for
     * @param  int      $last_visit  when was the last time the user visited this module
     * @param  string   $user_id     the user to get the notifcation-objects for
     *
     * @return array an array of ContentElement-objects
     */
    function getNotificationObjects($course_id, $since, $user_id)
    {
        return array();
    }
}
