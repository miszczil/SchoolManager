//jQuery(document).ready(function () {
//
//    var addSubjectLink = $('#canTeach a');
//    
//    var collectionHolder = $('#form_canTeach');
//
//    addSubjectLink.on('click', function (e) {
//        e.preventDefault();
//
//        // add a new tag form (see next code block)
//        addSubjectForm(collectionHolder, addSubjectLink);
//    });
//
//    function addSubjectForm(collectionHolder, addSubjectLink) {
//        // Get the data-prototype explained earlier
//        var prototype = collectionHolder.data('prototype');
//
//        // get the new index
//        var index = collectionHolder.data('index');
//
//        // Replace '__name__' in the prototype's HTML to
//        // instead be a number based on how many items we have
//        var newForm = prototype.replace(/__name__/g, index);
//
//        // increase the index with one for the next item
//        collectionHolder.data('index', index + 1);
//
//        // Display the form in the page in an li, before the "Add a tag" link li
//        addSubjectLink.before(newForm);
//
//    }
//});