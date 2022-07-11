let currentTab = 1;



setInterval(() => {
   var tabs = document.querySelectorAll("#pills-home-tab");
   tabs[currentTab].click();
   currentTab++;
   
   if (currentTab >= tabs.length)
    currentTab = 0;
}, 3000);

