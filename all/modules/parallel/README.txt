// $Id: README.txt,v 1.1.2.1 2010/03/18 05:30:42 mikeytown2 Exp $
Parallel module
===============


Installation
------------

 1) Create 1-3 new subdomains that point to your webroot directory.  If your
    site is example.com then create
      cdn1.example.com
      cdn2.example.com
      cdn3.example.com
    These new domains must have an IP address different from example.com for
    you to see any front-end performance improvement.  How to set this up is
    beyond the scope of this document.  But the easiest way to do so is to use
    an origin-pull CDN.

 2) Copy the Parallel module to sites/all/modules.

 3) Enable it in admin/build/modules.

 4) Navigate to admin/settings/performance and choose the parallel domains to
    use.  To ensure that your parallel domains work for both http:// and
    https://, use a schema relative URL in the format
      //example.com


Reasons that you may not see a front-end performance increase
-------------------------------------------------------------
 -  You may not have enough elements on a page for your browser to take
    advantage of parallelizing domains.
 -  Your parallel domains must have a different host name and different IP
    from your primary domain.
 -  Some browsers (noteably IE6) cannot parallel downloads from more than 2
    domains.
 -  Realistically you will only see parallelization within each resource type.
    The browser will not download all CSS, JS, and Images at the same time, but
    will be able to parallelize downloads within each of those groups.

Keep in mind that even if you don't experience a front-end performance
improvement, as long as your parallel domains are on a different server you
will still see a back-end improvement since your server has to serve fewer
resources per page.  By moving all static resources off of your primary server
you can then tune your server to act solely as an application server rather
than a combination application/file server.