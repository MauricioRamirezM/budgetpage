$(document).ready(function(){
    $('#table_conte').hide();
    getUserInfo();

    const msg_box = document.querySelector('.alert_msg');
    const msg_box_pro = document.querySelector('.alert_msg_pro');
   

    fetchAppoinments( );

    document.addEventListener('click', e => {
        if(e.target.matches('.edit_btn')){
            let apo_id = e.target.dataset.id ;
            updateAppoinment(apo_id, e.target.name)
        }
        if(e.target.matches('.cancel_btn ')){
            let apo_id = e.target.dataset.id ;
            deleteAppoinment(apo_id, e.target.name)

            
        }
        if(e.target.matches('#new_img') ){
            let src = e.target.getAttribute("src");
            let sibling =e.target.nextElementSibling;
            let title = sibling.firstElementChild.textContent;
            let description = sibling.lastElementChild.textContent;
            console.log(description)
            $('.img_new').attr('src', src) 
            $('.new_card_text').text(description)
            $('.new-card_title').text(title)
            $('.show_new ').fadeIn();
            const div = document.querySelector(".show_new");
            const divHeight = $(".show_new").outerHeight(true);
            $('.row_services').css('marginTop',divHeight + 30 );
            $(window).scrollTop(550)
        }
        if(e.target.matches('#new_title') ){
            let parent =e.target.parentNode;
            let src = parent.parentNode.firstElementChild.getAttribute('src')
            let title = e.target.textContent;
            let description = e.target.nextElementSibling.textContent
          
            
            $('.img_new').attr('src', src) 
            $('.new_card_text').text(description)
            $('.new-card_title').text(title)
            $('.show_new ').fadeIn();
            const div = document.querySelector(".show_new");
            const divHeight = $(".show_new").outerHeight(true);
            $('.row_services').css('marginTop',divHeight + 30 );
            $(window).scrollTop(550)
        }
    })
    $('.close_new_btn').on('click', (e) => {
        $('.show_new ').fadeOut();
        setTimeout(() => {
        $('.row_services').css('marginTop', "0");
        $(window).scrollTop(300)
        }, 700);


    })

    
  


        $('#apo_form').submit((e) => {
            e.preventDefault();
            const data = {
                id: $('#apo_id').val(),
                title: $('#apo_titleid').val(),
                date: $('#apo_dateid').val(),
                description: $('#apo_descriptionid').val(),
            };
    
            $.ajax({
                url: 'app/controllers/profileController.php',
                data: data,
                type:"POST",
                success: function (response) {
                $('#apo_dateid').css('border', '0 '); 
                $('#apo_dateid').css('border-bottom', '1px solid gray '); 

                    if(!response.error){
                        msg_box.classList.add( 'alert-info');
                        msg_box.classList.remove('hide', 'alert-danger');
                        msg_box.querySelector('.msg').textContent = response.message;
                        setTimeout(() => {
                        msg_box.classList.add('hide');
                        }, 2000);
                        fetchAppoinments();
                         $('#apo_form').trigger('reset');
                        

                    }
                    
                },
                
            })
            
        });


    
    





    function fetchAppoinments( ){
       
    const table = document.getElementById('apo_table');
    const template_box = document.getElementById('template')


    if(!template_box){
        return;
        
    }
    const template = document.getElementById('template').content;
        const fragment = document.createDocumentFragment();

        $.ajax({
            url:"app/controllers/profileController.php?action=fetch",
            type:"GET",
            success: function (response) {
                if(response.status === "success"){
                    response.data.forEach(appointment => {
                        template.querySelector('.id_tem').textContent = appointment.id;
                        template.querySelector('.title_tem').textContent = appointment.title;
                        template.querySelector('.date_tem').textContent = appointment.date;
                        template.querySelector('.description_tem').textContent = appointment.description;
                        template.querySelector('.cancel_btn').dataset.id = appointment.id;
                        template.querySelector('.edit_btn').dataset.id = appointment.id;
                        const clone = document.importNode(template, true);
                        fragment.appendChild(clone);
                    });
                 
                    table.appendChild(fragment);
                }
            },
            error: function (error) {
                console.log(error)
            }
        })

    }
    function updateAppoinment(id,action){
        $('#apo_descriptionid').prop('disabled', true);
        $('#apo_titleid').prop('disabled', true);
        $.ajax({
            url: `app/controllers/profileController.php?action=${action}`,
            data: {id},
            type:"GET",
            success: (response)=> {
                if(response.status !== "error"){
                    $('#apo_titleid').val(response.data.title);
                    $('#apo_dateid').val(response.data.date);
                    $('#apo_descriptionid').val(response.data.description);
                    $('#apo_id').val(response.data.id);
                    $('#apo_dateid').css('border', '1px solid green'); 
                } else{
                    console.log(response.data);
                    msg_box.classList.add( 'alert-danger');
                    msg_box.classList.remove('hide');
                    msg_box.querySelector('.msg').textContent = response.data;
                    setTimeout(() => {
                        msg_box.classList.add('hide');
                    }, 3000);
                }
                

            },
            error: (err)=> {
                console.log(err)
            }

        })
    }

    function deleteAppoinment(id, action){
        $.ajax({
            url:  `app/controllers/profileController.php?action=${action}`,
            data: { id },
            type:"GET",
            success: (response) => {
                
                msg_box.classList.add( 'alert-danger');
                msg_box.classList.remove('hide');
                msg_box.querySelector('.msg').textContent = response.message;
                setTimeout(() => {
                    msg_box.classList.add('hide');
                }, 3000);
                    fetchAppoinments( );
            },
            error: (error)=>{
                console.log(error);
            }

        })
    }
    

        




    function getUserInfo(){
        $.ajax({
            url: "app/controllers/profileController.php?userinfo=get",
            type: "GET",
            success: (response) => {
                if(response.status === "success"){

                    $('#nameid').val(response.data.name);
                    $('#usernameid').val(response.data.username);
                    $('#emailid').val(response.data.email);
                    $('#phoneid').val(response.data.phone);
                }
                
            },
        })

    }

    $('#profile_form').submit((e) => {
        e.preventDefault();
        const data = {
            name: $('#nameid').val(),
            username: $('#usernameid').val(),
            email: $('#emailid').val(),
            phone: $('#phoneid').val(),
            crr_password: $('#currentPasswordid').val(),
            new_password: $('#newPasswordid').val(),
            conf_password: $('#confirmPasswordid').val(),
        };
        console.log("hola")
        $.ajax({
            url: "app/controllers/profileController.php",
            data: data,
            type: "POST",
            success: (response) => {
                console.log("respuiesta")
                if(response.status == "success"){

                    $("html, body").animate({ scrollTop: 0 }, "smooth");
                    
                    msg_box_pro.classList.add('alert-info');
                    msg_box_pro.classList.remove('hide');
                    msg_box_pro.querySelector('.msg_pro').textContent = response.message;
                    setTimeout(() => {
                        msg_box_pro.classList.add('hide');
                    }, 3000);
                    $('#profile_form').trigger('reset');
                    getUserInfo();
                } else{
                    $("html, body").animate({ scrollTop: 0 }, "smooth");
                    
                    msg_box_pro.classList.add('alert-danger');
                    msg_box_pro.classList.remove('hide');
                    msg_box_pro.querySelector('.msg_pro').textContent = response.message;
                    setTimeout(() => {
                        msg_box_pro.classList.add('hide');
                    }, 3000);
                    $('#profile_form').trigger('reset');
                    getUserInfo();
                }

            }
        })
    })


  $('#contact_form').submit((e) => {
    e.preventDefault();
    const data = {
        name: $('#nameid').val(),
        phone: $('#phoneid').val(),
        email: $('#emailid').val(),
        description: $('#descriptionid').val(),
        contact : $("#contact_btn").attr("name"),
    };
    $.ajax({
        url: "app/controllers/contactController.php",
        data: data,
        type: "POST",
        dataType: "json", 
        success: (response) => {
                const contactAlert = document.querySelector('.contact-alert');
            if(response.status === "success"){
                console.log(response)
                $("html, body").animate({ scrollTop: 0 }, "smooth");
                
                contactAlert.classList.add('alert-info');
                contactAlert.classList.remove('hide');
                contactAlert.querySelector('.msg_con').textContent = response.message;
                setTimeout(() => {
                    contactAlert.classList.add('hide');
                }, 3000);
                $('#contact_form').trigger('reset');
            }else{
                $("html, body").animate({ scrollTop: 0 }, "smooth");
                
                contactAlert.classList.add('alert-danger');
                contactAlert.classList.remove('hide');
                contactAlert.querySelector('.msg_con').textContent = response.message;
                setTimeout(() => {
                    contactAlert.classList.add('hide');
                }, 3000);
                $('#contact_form').trigger('reset');
            }
        },
        error: (err) =>{
            console.log(err);
        }
    })

  })

})

