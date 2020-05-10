import { Component, OnInit, Input } from '@angular/core';
import { Item } from 'src/app/core/models/item.model';
import { CartService } from 'src/app/core/services/cart.service';
import { takeUntil } from 'rxjs/operators';
import { Subject } from 'rxjs';

@Component({
  selector: 'app-item-card',
  templateUrl: './item-card.component.html',
  styleUrls: ['./item-card.component.scss']
})
export class ItemCardComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  
  @Input()
  data: Item;
  
  isInCart = false;
  constructor(
    private cartService: CartService,
  ) { }

  ngOnInit(): void {
    this.checkIfInCart()
    this.cartService.cartChanged.pipe(takeUntil(this.destroy)).subscribe(res => {
      this.checkIfInCart()
    })
  }
  
  addToCart(){
    this.cartService.add(this.data);
  }

  checkIfInCart(){
    const cart = this.cartService.get();
    if (cart) {
      this.isInCart = cart.find(el=> el.id === this.data.id) ? true : false;
    }
  }
  
  
  ngOnDestroy(): void {
    this.destroy.next();
    this.destroy.complete();
  }
}
