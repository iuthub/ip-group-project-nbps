import { faMinus, faPlus, faTrash, faArrowRight, faCreditCard, faMoneyBill, faTimes, faCircleNotch } from '@fortawesome/free-solid-svg-icons';

import { Component, OnInit, TemplateRef } from '@angular/core';
import { CartService } from 'src/app/core/services/cart.service';
import { Item } from 'src/app/core/models/item.model';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { OrderService } from 'src/app/core/services/order.service';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { environment } from '../../../environments/environment';



@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.scss']
})
export class CartComponent implements OnInit {
  storageUrl = environment.storageUrl;

  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();

  faMinus = faMinus;
  faPlus = faPlus;
  faTrash = faTrash;
  faArrowRight = faArrowRight;
  faCreditCard = faCreditCard;
  faMoneyBill = faMoneyBill;
  faTimes = faTimes;
  faCircleNotch = faCircleNotch;

  isLoading = false;

  cartItems: Item[] = [];
  total = 0;

  modalRef: BsModalRef;

  paymentType: string;



  constructor(
    private cartService: CartService,
    private modalService: BsModalService,
    private orderService: OrderService,
    private router: Router,
    private toastr: ToastrService,
  ) {

  }

  ngOnInit(): void {
    const cart = this.cartService.get();
    if (cart) {
      this.cartItems = cart.map(el => {
        el.quantity = el.quantity ? el.quantity : 1;
        this.total += el.quantity * el.price;
        return el;
      });
    }


  }

  decrease(item: Item) {
    let quantity = item.quantity - 1;
    if (quantity <= 0) {
      return
    } else {
      item.quantity = quantity;
      this.total -= item.price;
      this.cartService.set(this.cartItems);
    }
  }
  add(item: Item) {
    item.quantity++;
    this.total += item.price;
    this.cartService.set(this.cartItems);
  }

  deleteItem(itemId: number) {
    this.cartItems = this.cartItems.filter((el) => {
      if (el.id === itemId) {
        this.total -= el.price * el.quantity;
        return false;
      }
      return true;
    });

    this.cartService.set(this.cartItems);
    this.cartService.cartChanged.next(this.cartItems.length);
  };

  openModal(template: TemplateRef<any>) {
    this.modalRef = this.modalService.show(template);
  };

  checkout() {
    this.isLoading = true;

    const data = {
      payment_type: this.paymentType,
      items: this.cartItems.map(el => {
        return {
          id: el.id,
          quantity: el.quantity
        }
      }),
    }


    this.orderService.setOrder(data).pipe(takeUntil(this.destroy)).subscribe(res => {
      console.log(res);
      this.toastr.success("Your order has been placed. Please wait for the operator.");
      this.router.navigate(["/"]);

      this.cartService.clear();
      this.cartItems = [];
    },
      null,
      () => {
        this.isLoading = false;
        this.modalRef.hide();
      }
    )
  }

  clearCart() {
    this.cartService.clear();
    this.cartItems = [];
    this.toastr.success("Cart cleared");
  }

  ngOnDestroy() {
    this.destroy.next();
    this.destroy.complete();
  }
}
