/**
 * Album Photos meta box — multi-select media picker with drag-to-reorder.
 *
 * Stores a comma-separated list of attachment IDs in the hidden #ec-album-images
 * field, which functions.php saves to the _ec_album_images post meta.
 */
(function ($) {
    'use strict';

    $(function () {
        var $field  = $('#ec-album-images');
        var $list   = $('#ec-album-photos-list');
        var $add    = $('#ec-album-add-photos');
        var $clear  = $('#ec-album-clear-photos');

        if (!$field.length) {
            return;
        }

        var frame;

        // Sync the hidden field from the current thumbnail order in the DOM.
        function sync() {
            var ids = $list.children('.ec-album-photo').map(function () {
                return $(this).data('id');
            }).get();
            $field.val(ids.join(','));
        }

        // Append a thumbnail for an attachment to the list.
        function addThumb(attachment) {
            // Skip if already present.
            if ($list.find('.ec-album-photo[data-id="' + attachment.id + '"]').length) {
                return;
            }
            var url = attachment.sizes && attachment.sizes.thumbnail
                ? attachment.sizes.thumbnail.url
                : attachment.url;
            var $li = $('<li class="ec-album-photo"></li>').attr('data-id', attachment.id);
            $('<img alt="">').attr('src', url).appendTo($li);
            $('<button type="button" class="ec-album-photo-remove" aria-label="Remove photo">&times;</button>').appendTo($li);
            $list.append($li);
        }

        // Drag to reorder.
        if ($.fn.sortable) {
            $list.sortable({
                items: '> .ec-album-photo',
                cursor: 'move',
                tolerance: 'pointer',
                update: sync
            });
        }

        $add.on('click', function (e) {
            e.preventDefault();

            if (frame) {
                frame.open();
                return;
            }

            frame = wp.media({
                title: (window.ecAlbum && ecAlbum.title) || 'Add Photos',
                button: { text: (window.ecAlbum && ecAlbum.button) || 'Add to Album' },
                library: { type: 'image' },
                multiple: 'add'
            });

            frame.on('select', function () {
                var selection = frame.state().get('selection');
                selection.each(function (attachment) {
                    addThumb(attachment.toJSON());
                });
                sync();
            });

            frame.open();
        });

        // Remove a single photo.
        $list.on('click', '.ec-album-photo-remove', function (e) {
            e.preventDefault();
            $(this).closest('.ec-album-photo').remove();
            sync();
        });

        // Clear all.
        $clear.on('click', function (e) {
            e.preventDefault();
            $list.empty();
            sync();
        });
    });
})(jQuery);
