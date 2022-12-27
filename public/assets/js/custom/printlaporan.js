function printlaporan(url){
  // MyWindow=window.open('/dashboard/logbook/print','MyWindow','width=800,height=600'); 
  // return false;
  window.open('/print/'+url,'POPUP WINDOW TITLE HERE','width=800,height=800').print()
}