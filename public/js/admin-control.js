$(document).ready(function () {
    $(".btn-click-edit").click(function () {
        var x = document.querySelectorAll(".panel-content");
        for (var i = 0; i < x.length; i++) {
            x[i].value = x[i].defaultValue;
        }

        id = $(this).val();
        $(".block-button-edit").hide();
        $(".block-button-default").show();
        $(".panel-content").attr("disabled", "disabled");
        $(".panel-content").addClass("inactive");
        $(".input-" + id).removeClass("inactive");
        $(".input-" + id).removeAttr("disabled");
        $("#buttonDefault" + id).hide();
        $("#buttonEdit" + id).show();
    });

    $(".btn-click-cancle").click(function () {
        $(".panel-content").attr("disabled", "disabled");
        $(".panel-content").addClass("inactive");
        $(".block-button-edit").hide();
        $(".block-button-default").show();
        $(".alert").hide();
    });

    $(".btn-click-save-edit").click(function () {
        id = $(this).val();

        url = "/admin/admin_update_progress/" + id;
        data = {
            username: $("#name" + id).val(),
            email: $("#email" + id).val(),
            level: $("#level" + id).val(),
        };
        $.ajax({
            type: "PUT",
            url: url,
            data: data,
            success: function (response) {
                if (response.msg_n != "") {
                    document.getElementById("alertEditName" + id).innerHTML =
                        response.msg_n;
                    $("#alertEditName" + id).show();
                }
                if (response.msg_e != "") {
                    document.getElementById("alertEditEmail" + id).innerHTML =
                        response.msg_e;
                    $("#alertEditEmail" + id).show();
                }
                if (response.msg_l != "") {
                    document.getElementById("alertEditLevel" + id).innerHTML =
                        response.msg_l;
                    $("#alertEditLevel" + id).show();
                }
                if(response.err == false) {
                    $(".alert").hide();
                    $(".panel-content").attr("disabled", "disabled");
                    $(".panel-content").addClass("inactive");
                    $(".block-button-edit").hide();
                    $(".block-button-default").show();
                    $("#name" +id).removeAttr("value");
                    $("#name" +id).attr("value",response.data.username);
                    $("#email" +id).removeAttr("value");
                    $("#email" +id).attr("value",response.data.email);
                    $("#level" +id).removeAttr("value");
                    $("#level" +id).attr("value",response.data.level);
                }
            },
        });
    });
    $(".btn-click-delete").click(function(){
        id = $(this).val();
        url = "/admin/admin_del_progress/"+id;
        $.ajax({
            type: "DELETE",
            url:url,
            success: function(response){
                console.log(response.data);
                $("#alert-success-data-user").show();
                $("#widgetView"+id).remove();
                document.getElementById("alert-success-data-user").innerHTML = "delete employee "+response.data.username+" successfully";
            }
        })
    })
    $("#btnAdmin").click(function(){
        $(".btn-change-view").removeClass("active");
        $("#btnAdmin").addClass("active")
        $(".section-tab").removeClass("active");
        $("#sectionViewAdmin").addClass("active");
    });
    $("#btnTodo").click(function(){
        $(".btn-change-view").removeClass("active");
        $("#btnTodo").addClass("active");
        $(".section-tab").removeClass("active");
        $("#sectionViewTodo").addClass("active");
    })

    $("#myWorkTodo").click(function(){
        $("#myPostWork").removeClass("active");
        $("#myPostPanel").removeClass("active");
        $("#myWorkPanel").addClass("active");
        $("#myWorkTodo").addClass("active");
    })

    $("#myPostWork").click(function(){
        $("#myWorkPanel").removeClass("active");
        $("#myWorkTodo").removeClass("active");
        $("#myPostWork").addClass("active");
        $("#myPostPanel").addClass("active");
    })

    $("#formAddMyTodo").submit(function(e){
        e.preventDefault();
        url = "/admin/add_new_todo";
        data = {
            admin_do: $("#admindoTodoAdd").val(),
            start: $("#startdateTodoAdd").val(),
            finish: $("#enddateTodoAdd").val(),
            notes: $("#noteTodoAdd").val(),
        }
        console.log(data)
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                if (response.msg_start != ""){
                    document.getElementById("alertStartAdd").innerHTML = response.msg_start;
                    $("#alertStartAdd").show();
                }else{
                    $("#alertStartAdd").hide();
                }
                if (response.msg_end != ""){
                    document.getElementById("alertEndAdd").innerHTML = response.msg_end;
                    $("#alertEndAdd").show();
                }else{
                    $("#alertEndAdd").hide();
                }
                if (response.msg_level != ""){
                    document.getElementById("alertLevelAdd").innerHTML = response.msg_end;
                    $("#alertLevelAdd").show();
                }else{
                    $("#alertLevelAdd").hide();
                }
                if(response.error == false){
                    window.location.href = thisUrl;
                }
            }
        })
    })
    $(".alert").hide();
    $("#formAddEmployeeTodo").submit(function(e){
        e.preventDefault();
        url = "/admin/add_new_todo";
        data = {
            admin_do: $("#chooseEmployee").val(),
            start: $("#startAddE").val(),
            finish: $("#endAddE").val(),
            notes: $("#notedoAddE").val(),
        }
        console.log(data)
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                if (response.msg_start != ""){
                    document.getElementById("alertStartE").innerHTML = response.msg_start;
                    $("#alertStartE").show();
                }else{
                    $("#alertStartE").hide();
                }
                if (response.msg_end != ""){
                    document.getElementById("alertEndE").innerHTML = response.msg_end;
                    $("#alertEndE").show();
                }else{
                    $("#alertEndE").hide();
                }
                if (response.msg_level != ""){
                    document.getElementById("alertEmE").innerHTML = response.msg_end;
                    $("#alertEmE").show();
                }else{
                    $("#alertEmE").hide();
                }
                console.log(response.admin)
                if(response.error == false){
                    window.location.href = thisUrl;
                }
            }
        })
    })

    $(".btn-edit-my-work").click(function(){
        var id = $(this).val();
        var url = "/admin/render_todo/"+id;
        $.ajax({
            type :"GET",
            url : url,
            success: function (response) {
                console.log(response.data)
                document.getElementById("noteTodoEdit").value = response.data.notes
                document.getElementById("startdateTodoEdit").value = response.data.start_time
                document.getElementById("enddateTodoEdit").value = response.data.end_time
                document.getElementById("btnMyWorkEditSubmit").value = response.data.id
            }
        })
    })

    $(".btn-edit-em-work").click(function(){
        var id = $(this).val();
        var url = "/admin/render_todo/"+id;
        $.ajax({
            type :"GET",
            url : url,
            success: function (response) {
                console.log(response.data)
                document.getElementById("notedoEditE").value = response.data.notes
                document.getElementById("startEditE").value = response.data.start_time
                document.getElementById("endEditE").value = response.data.end_time
                document.getElementById("inputEmployeeEdit").value = response.data.admin_do
                document.getElementById("btnEmWorkEditSubmit").value = response.data.id
            }
        })
    })

    $("#formEditEmployeeTodo").submit(function(e){
        e.preventDefault();
        id = $("#btnEmWorkEditSubmit").val()
        url = '/admin/edit_todo/'+id;
        data = {
            admin_do: $("#inputEmployeeEdit").val(),
            start_time: $("#startEditE").val(),
            end_time: $("#endEditE").val(),
            notes: $("#notedoEditE").val(),
        }
        $.ajax({
            type: "PUT",
            url : url,
            data : data,
            success: function(response){
                if (response.msg_start != ""){
                    document.getElementById("alertStartEmEdit").innerHTML = response.msg_start;
                    $("#alertStartEmEdit").show();
                }else{
                    $("#alertStartEmEdit").hide();
                }
                if (response.msg_end != ""){
                    document.getElementById("alertEndEmEdit").innerHTML = response.msg_end;
                    $("#alertEndEmEdit").show();
                }else{
                    $("#alertEndEmEdit").hide();
                }
                if (response.msg_level != ""){
                    document.getElementById("alertLevelEmEdit").innerHTML = response.msg_end;
                    $("#alertLevelEmEdit").show();
                }else{
                    $("#alertLevelEmEdit").hide();
                }
                if(response.error == false){
                    $(".modal").hide();
                    $(".modal-backdrop.show").hide();
                    $("#editEmployeeTodo").hide();
                    document.getElementById("myNote"+id).innerHTML = response.data.notes
                    document.getElementById("myStart"+id).innerHTML = response.data.start_time
                    document.getElementById("myEnd"+id).innerHTML = response.data.end_time
                }

                console.log(response.data)

            }
        })

    })

    $("#formEditMyTodo").submit(function(e){
        e.preventDefault();
        id = $("#btnMyWorkEditSubmit").val()
        url = '/admin/edit_todo/'+id;
        data = {
            admin_do: $("#admindoTodoEdit").val(),
            start_time: $("#startdateTodoEdit").val(),
            end_time: $("#enddateTodoEdit").val(),
            notes: $("#noteTodoEdit").val(),
        }
        console.log(data)
        $.ajax({
            type: "PUT",
            url : url,
            data : data,
            success: function(response){
                if (response.msg_start != ""){
                    document.getElementById("alertStartEdit").innerHTML = response.msg_start;
                    $("#alertStartEdit").show();
                }else{
                    $("#alertStartEdit").hide();
                }
                if (response.msg_end != ""){
                    document.getElementById("alertEndEdit").innerHTML = response.msg_end;
                    $("#alertEndEdit").show();
                }else{
                    $("#alertEndEdit").hide();
                }
                if (response.msg_level != ""){
                    document.getElementById("alertLevelEdit").innerHTML = response.msg_end;
                    $("#alertLevelEdit").show();
                }else{
                    $("#alertLevelEdit").hide();
                }
                if(response.error == false){
                    $(".modal").hide();
                    $(".modal-backdrop.show").hide();
                    $("#editEmployeeTodo").hide();
                    document.getElementById("myNote"+id).innerHTML = response.data.notes
                    document.getElementById("myStart"+id).innerHTML = response.data.start_time
                    document.getElementById("myEnd"+id).innerHTML = response.data.end_time
                }

                console.log(response.data)

            }
        })

    })

    $(".btn-del-work").click(function(){
        id = $(this).val();
        console.log("delete "+id);
        url = "/admin/delete_todo/"+id;
        $.ajax({
            type:"DELETE",
            url:url,
            success:function (response) {
                $(".wg-panel-"+id).remove();
            }
        })
    })
    $(".btn-check-done").click(function() {
        id = $(this).val();
        _this = $(this);
        console.log(id);
        url = "/admin/change_status_check/"+id;
        $.ajax({
            type: "PUT",
            url:url,
            success: function (response) {
                _this.remove();
                document.getElementById("wg-panel-"+id).style.background = "green"
                document.getElementById("wg-panel-"+id).style.border = "2px solid green"
                document.getElementById("wg-panel-"+id).style.color = "#fff"
            }
        })
    })
});
