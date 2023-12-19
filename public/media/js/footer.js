if (!getCookie('dark')) {
    setCookie('dark','no',365);
    darkmode();
}else {
    var dark = getCookie('dark');
    //console.log(dark);
    if (dark == 'no') {
        $('#darkMode').removeAttr('checked');
        darkmode();
    }
}

if (!getCookie('menu')) {
    setCookie('menu','yes',365);
}else {
    var menu = getCookie('menu');
    if(menu == 'no'){
        console.log(menu);
        $('#bodyScrap').addClass('sidebar-xs');
    }
} 

function setCookie(cname,cvalue,exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

function changeDark() {
    var dark = getCookie('dark');
    if (dark == 'no') {
        setCookie('dark','yes',365);
        darkmode();
    }else if(dark == 'yes') {
        setCookie('dark','no',365);
        darkmode();
    }
}

function sidebarCollapse() {
    var menu = getCookie('menu');
    if (menu == 'no') {
        setCookie('menu','yes',365);        
    }else if(menu == 'yes') {
        setCookie('menu','no',365);        
    }
}