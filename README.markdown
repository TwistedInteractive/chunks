# Chunks #

This is a very basic way to put 'chunks' of content in your websites.

## A what now? ##

A chunk: a small piece of content that is editable through the frontend. When the user is logged in, they see tiny
edit-buttons at pieces of content (chunks) they can edit. A click on the edit-button will open a new window, allowing
the user to only edit the specific piece of content, save and close.

## Sound difficult! ##

But it isn't! These are the steps needed:

 1. Create a section for your chunks with a textarea or inputfield.
 2. Create a datasource with the chunks and attach them to the pages where you are going to use them.
 3. Include the `chunks.xsl`-utility on each page where you are going to use chunks.
 4. Call them like so: `<xsl:apply-templates select="chunks/entry[@id=...]" mode="chunk" />`, where `@id` offcourse is the ID of your chunk.

To have less overhead, you can filter the chunks datasource to only load the chunks needed for specific pages:

 1. Install the [pages field extension](http://symphonyextensions.com/extensions/pagesfield/).
 2. Create a chunks-section with a textarea or inputfield and a pages field
 3. For each chunk you create, set on which page it will be available.
 4. Filter the chunks-datasource on `{$current-page-id}`.

## What about images? What about multilanguage? ##

Well, actually, that shouldn't be too much of a problem, since the edit-window is in fact Symphonys' native `publish/edit`-page.
The extension only uses some CSS to hide all the fields which aren't `textarea` or `input`, but this is ofcourse easily
adjusted to fit your needs. And as always... Feel Free To Fork (tm). ;-)

## And Rich Text Editors? ##

Currently, only CKEditor is supported, but if you feel your favourite editor is missing, Feel Free To Fork (tm) to you too!