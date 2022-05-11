// $('document').ready(function () {
//     $(document).on('change', 'input#nickname', function() {
//
//     });
//
//     $("#nickname").on('input',function () {
//
//         var slug = slugify($(this).val());
//
//         $('input#slug').val(slug);
//     })
// });
//
// function slugify(text)
// {
//     return text.toString().toLowerCase()
//         .replace(/\s+/g, '-')           // Replace spaces with -
//         .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
//         .replace(/\-\-+/g, '-')         // Replace multiple - with single -
//         .replace(/^-+/, '')             // Trim - from start of text
//         .replace(/-+$/, '');            // Trim - from end of text
// }
