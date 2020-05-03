import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class DOMService {

  constructor() { }
  
  lockScroll(){
    //Turn NodeList to array
    const targets = [].slice.call(document.querySelectorAll('html, body'));
    for (const target of targets) {
      target.style.overflow = "hidden";
    }
  }
  
  unlockScroll(){
    //Turn NodeList to array
    const targets = [].slice.call(document.querySelectorAll('html, body'));
    for (const target of targets) {
      target.style.overflow = "";
    }
  }
  
  
  

}