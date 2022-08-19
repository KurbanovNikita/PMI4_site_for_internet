tinymce.init({
                selector: '#myTextarea',
                width: 600,
                height: 300,
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'table emoticons template paste help'
                ],
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                        'forecolor backcolor emoticons | help | tablecellvalign',
                menu: {
                    favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
                },
//                image_title: true,
//                automatic_uploads: true,
//                file_picker_types: 'image',
//                a11y_advanced_options: true,
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                            input.onchange = function () {
                                var file = this.files[0];

                                var reader = new FileReader();
                                reader.onload = function () {
                                    /*
                                     Note: Now we need to register the blob in TinyMCEs image blob
                                     registry. In the next release this part hopefully won't be
                                     necessary, as we are looking to handle it internally.
                                     */
                                    var id = 'blobid' + (new Date()).getTime();
                                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                    var base64 = reader.result.split(',')[1];
                                    var blobInfo = blobCache.create(id, file, base64);
                                    blobCache.add(blobInfo);

                                    /* call the callback and populate the Title field with the file name */
                                    cb(blobInfo.blobUri(), {title: file.name});
                                };
                                reader.readAsDataURL(file);
                            };

                            input.click();
                        },
                menubar: 'favs file edit view insert format tools table help',
                //content_css: 'content.css'
            });

