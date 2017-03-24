/**
 * Created by mikey on 3/20/2017.
 */

    function setClassID(classID) {
        alert(classID);
        document.getElementById['classID'].value=(classID);
        document.getElementById('gradeBook').submit();
    $.ajax({
        url: 'ajax.php', //This is the current doc
        type: "POST",
        data: ({name: 145}),
        success: function(data){
            console.log(data);
            alert(data);
            //or if the data is JSON
            var jdata = jQuery.parseJSON(data);
        }
    });
}

