jQuery.fn.fileInput = function () {
    var _this = jQuery(this);
    
    var multiple = _this.is('[multiple]');
    
    var uploading = false;
    
    _this.closest('form').submit(function () {
        return ! uploading;
    });
    
    _this.on('change', function (event) {
        uploading = true;
        
        var queue = [];
        var uploadIds = [];
        
        jQuery.each(this.files, function () {
            var formData = new FormData();
            formData.append('file', this);

            queue.push($.ajax({
                url: _this.attr('data-upload-url'),
                type: 'POST',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function (response) {
                    if (response.success) {
                        uploadIds.push(response.uploadId);
                    } else {
                        alert(response.message);
                    }
                }
            }));
        });
        
        jQuery.when.apply(jQuery, queue).then(function () {
            if (multiple) {
                $('#' + _this.attr('data-hidden-id')).val(JSON.stringify(uploadIds));
            } else {
                $('#' + _this.attr('data-hidden-id')).val(uploadIds[0]);
            }
            
            uploading = false;
        });
    });
};
