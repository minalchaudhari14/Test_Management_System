$(document).ready(function () {
    var testCreation = JSON.parse(localStorage.getItem('test_creation')) || [];
    var courseIds = []
    $.each(testCreation, function (key, value) {
         selectCourse = JSON.parse(value['selectCourse']);
         courseIds.push(selectCourse);
    });
    selectquesset(courseIds);
});
function selectquesset(courseIds) {
    console.log(courseIds);
    var select = $('#qset_id')[0];
    multi(select, {
        enable_search: true,
        "ajax": {
            "url": baseurl + 'AddNewTestController/MapSet',
           "data":{courseIds:courseIds}
        }
    });
}
