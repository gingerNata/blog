tinymce.init({
    selector: 'textarea',
    language: 'ru',
    skin: 'custom',
    editor_deselector : "mceNoEditor",
//            content_css : '/mycontent.css',
    menubar: false,
    toolbar: 'undo redo styleselect  forecolor backcolor fontselect fontsizeselect bold italic alignleft aligncenter alignright bullist ' +
    'advlist numlist code link unlink image hr outdent indent anchor table tabledelete',
    plugins: 'advlist code hr image imagetools anchor link paste table textcolor colorpicker media textcolor lists',

    images_upload_url: '/postAcceptor.php'
});