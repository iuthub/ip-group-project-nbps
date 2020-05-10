import { Component, OnInit } from '@angular/core';
import { OrderService } from 'src/app/core/services/order.service';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { BookingService } from 'src/app/core/services/booking.service';
import { Order } from 'src/app/core/models/order.model';
import { Booking } from 'src/app/core/models/booking.model';

@Component({
  selector: 'app-user-orders',
  templateUrl: './user-orders.component.html',
  styleUrls: ['./user-orders.component.scss']
})
export class UserOrdersComponent implements OnInit {

  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();

  isOrdersLoading = true;
  isBookingsLoading = true;

  constructor(
    private orderService: OrderService,
    private bookingService: BookingService,
  ) { }

  orders: Order[] = [];
  bookings: Booking[] = [];

  ngOnInit(): void {


    this.orderService.getAllOrders().pipe(takeUntil(this.destroy)).subscribe((res) => {
      this.orders = res.orders;
    },
      null,
      () => this.isOrdersLoading = false
    );

    this.bookingService.getAllBookings().pipe(takeUntil(this.destroy)).subscribe((res) => {
      this.bookings = res;
    },
      null,
      () => this.isBookingsLoading = false
    );
  }


  formatDate(date: string) {
    return new Date(date).toLocaleDateString('en-US', {
      month: 'long',
      day: '2-digit',
      year: 'numeric',
    })
  }



  ngOnDestroy() {
    this.destroy.next();
    this.destroy.complete();
  }

}
