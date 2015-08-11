function getDt(){
        dt=new Date(); 
        hrs=dt.getHours();
        min=dt.getMinutes(); 
        sec=dt.getSeconds(); 
        tm=" "+((hrs<10)?"0":"") +hrs+":"; 
        tm+=((min<10)?"0":"")+min+":";
        tm+=((sec<10)?"0":"")+sec+" "; 
        document.log.display.value=tm; 
        setTimeout("getDt()",1000);
}