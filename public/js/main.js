const d = document;
d.addEventListener("DOMContentLoaded", (e) => {
    hamburguerMenu(".panel_btn", ".panel", ".menu-link");
    showPassowrdSection('togglePasswordChange', 'passwordChangeSection');
    applydiscount()
    // const map_box = d.querySelector(".map");
    // if(map_box){
        initMap();
    // }

})


function hamburguerMenu(clsPanelBtn, clsPanel, clsMenuLink){
    const panelBtn = d.querySelector(clsPanelBtn);
    const panel = d.querySelector(clsPanel);
const menuLink = d.querySelector(clsMenuLink);
    
    d.addEventListener('click', (e)=> {
    if(e.target.matches(clsPanelBtn) || e.target.matches(`${clsPanelBtn} *`) ){
        panel.classList.toggle("is-active");
        panelBtn.classList.toggle("is-active");
    }
    if(e.target.matches(clsMenuLink)){
        panel.classList.remove("is-active");
        panelBtn.classList.remove("is-active");
    }
    })
}


function showPassowrdSection(idButton, idSection){
    const button = d.getElementById(idButton);
    const passwordSection = d.getElementById(idSection);
    if(button && passwordSection){

        button.addEventListener('click', function () {
            if (passwordSection.style.display === 'none') {
                passwordSection.style.display = 'block';
            } else {
                passwordSection.style.display = 'none';
                
            }
        });
    }
}


let subtotal = 0;


function getDiscount(price, months){
    if(months ==""){
        return;
    }
    const discount = d.querySelector('.porcent');
    const priceDiscount = d.querySelector('.subtotal')

    let porcent;

    switch(months){
        case '1':
            subtotal = price - (price * .05); 
            porcent = "(5%)";
        break;
        case '2':
            subtotal = price - (price * .10); ; 
            porcent = "(10%)";
        break;
        case '3':
            subtotal = price - (price * .15); ; 
            porcent = "(15%)";
        break;
        default:
            subtotal = price - (price * .20); ; 
            porcent = "(20%)";
        break;
    }
    discount.textContent = porcent;
    priceDiscount.textContent = subtotal + "€";
    // totalBox.textContent = `Total: ${subtotal}€`;

    
    addSections(subtotal);
}


function applydiscount(){
        const invite = d.createElement('span');
        invite.textContent = "Get in contact with our team to compleate your website";
        invite.classList.add('hide', 'invite');
        const card = d.getElementById('card_body');
        if(card){
            card.insertAdjacentElement('afterend', invite);
        }

        d.addEventListener('change', e => {
            const selectForm = d.getElementById('websites_select');
            const months = d.getElementById('monthsid');
            
           

            if(e.target === selectForm ){
                if(!months.value || isNaN(months.value)){
                    invite.classList.add('hide');

                    months.style.border = "1px solid #bd0909";
                    months.style.boxShadow = "1px 1px 10px  #bd0909";
                }else{
                    months.style.boxShadow = "none";
                }

                selectedOption = e.target.options[e.target.selectedIndex];
                
                pagePrice = parseInt(selectedOption.value);
                let termMonths = months.value;
                getDiscount(pagePrice, termMonths);
                invite.classList.remove('hide');
                
            }
        })


}

function addSections(discount ){
const totalBox = d.querySelector('.total');

    
    const options = d.querySelectorAll('#checkbox');
    d.addEventListener('change', e =>{
        if(e.target.matches('#checkbox')){
            let list = Array.from(options);
            let extras = list.reduce((acc, box) => {
                let isChecked = box.checked ? parseInt(box.value) : 0;
                return acc + isChecked;
            },0)
            let totalExtras = extras;
            let total = discount +totalExtras;
            totalBox.textContent = `Total: ${total}€`;
        }
        
        
    })
   

}


let map;

async function initMap() {
    const position = { lat: 0, lng: 0 };

    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    
    map = new Map(d.getElementById("map"), {
        zoom: 13,
        center: position,
        mapId: "DEMO_MAP_ID",
    });


    const marker = new AdvancedMarkerElement({
        map: map,
        position: position,
        title: "position by default",
    });
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((pos) => {
            const currenLoc = {
            lat: pos.coords.latitude,
            lng: pos.coords.longitude
        };

        const mark = new AdvancedMarkerElement({
            map: map,
            position: currenLoc,
            title: "You are here",
        });

            map.setCenter(currenLoc);
        }, (error) => {
            alert("We can not  get your location");
        });
    } else {
        alert("You should give access to your device's location. Check your settings.");
    }
}










