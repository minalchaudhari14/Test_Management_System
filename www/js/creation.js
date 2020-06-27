$(document).ready(function () {
    removeLocalStorageData();
    $("#subBtn").click(function () {
        addLocalData();
    })
});
function removeLocalStorageData() {
    localStorage.clear();
}
function addLocalData() {
    
    var testCreation = new Array();
    var errors = new Array();

    if ($('#test_name').val() == '')
        errors.push("Please Enter Test Name!");

    if ($('#duration').val() == '')
        errors.push("Please Enter Duration!");

    if ($('#totalmark').val() == '')
        errors.push("Please Enter Total Mark!");

    if ($('#selectCourse').val() == '')
        errors.push("Please Select Course!");

    if (errors.length > 0)
    {
        bootbox.alert({
            message: errors.join("<br>"),
            centerVertical: true,

        });
        return false;
    }
    
//    $('[name=selectCourse]').val( value.course_id );
    var obj = {};
    // get value of user input
    obj.test_id = $('#test_id').val();
    obj.test_name = $('#test_name').val();
    obj.duration = $('#duration').val();
    obj.totalmark = $('#totalmark').val();
    obj.selectCourse = $('#selectCourse').val();
    testCreation.push(obj);
    localStorage.setItem('test_creation', JSON.stringify(testCreation));
    
    bootbox.alert({
        message: "Proceed to Next....",
        callback: function () {
            window.location.href = baseurl + 'Mapset';
//            var testCreation = JSON.parse(localStorage.getItem('test_creation')) || [];
//            var courseIds = []
//            $.each(testCreation, function (key, value) {
//                selectCourse = JSON.parse(value['selectCourse']);
//                courseIds.push(selectCourse);
//                selectquesset( courseIds);
//            });
        }
         
    });
}
//function selectquesset( courseIds) {
//    console.log(courseIds);
//    var select = $('#qset_id')[0];
//    multi(select, {
//        enable_search: true,
//        "ajax": {
//            "url": baseurl + 'AddNewTestController/MapSet',
//            "data": {courseIds: courseIds}
//        }
//    });
//}


