import { Injectable } from '@angular/core';
import { Item } from '../models/item.model';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  //Cart changed event
  cartChanged = new BehaviorSubject<number>(0);
  
  
  
  constructor(){
    const cartString = window.localStorage.getItem("cart");
    if (cartString) {
      let cart = JSON.parse(window.localStorage.getItem("cart"));
      if (cart.length) {
        this.cartChanged.next(cart.length);
      }
    }
  }
  
  add(item: Item) {
    const cartString = window.localStorage.getItem("cart");
    let cart;
    if (cartString) {
      cart = JSON.parse(cartString);
      cart.push(item);
      this.cartChanged.next(cart.length);
    } else {
      //Add a single item to cart
      cart = [item];
    }
    window.localStorage.setItem("cart", JSON.stringify(cart));
    this.cartChanged.next(cart.length);
  };

  remove(itemId: string) {
    const cartString = window.localStorage.getItem("cart");
    if (cartString) {
      let cart = JSON.parse(window.localStorage.getItem("cart"));
      cart = cart.filter((el) => el.id !== itemId);
      if (cart.length) {
        window.localStorage.setItem("cart", JSON.stringify(cart))
        this.cartChanged.next(cart.length);
      } else {
        window.localStorage.removeItem("cart");
      }
    }
  };


  clear() {
    const cartString = window.localStorage.getItem("cart");
    if (cartString) {
      this.cartChanged.next(0);
      window.localStorage.removeItem("cart");
    }
  };


  get() : Item[] {
    const cartString = window.localStorage.getItem("cart");
    if (cartString) {
      let cart = JSON.parse(window.localStorage.getItem("cart"));
      if (cart.length) {
        return cart;
      }
    }
  }
  set(cart: Item[]): void {
    window.localStorage.setItem("cart", JSON.stringify(cart));
  }








}