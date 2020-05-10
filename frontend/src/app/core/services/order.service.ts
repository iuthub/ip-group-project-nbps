import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Order } from '../models/order.model';
import { Item } from '../models/item.model';
import { NotificationService } from './notification.service';


const API_DATA_URL = environment.serverUrl;

enum PaymentType{
  cash,
  card
}

@Injectable({
  providedIn: 'root'
})
export class OrderService {

  constructor(private http: HttpClient, private notificationService: NotificationService) { }


  getAllOrders(): Observable<{orders: Order[]}> {
    const url = API_DATA_URL+"/orders"
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }
  getOrderById(id:number): Observable<Order> {
    const url = API_DATA_URL+"/order/"+id;
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  };
  
  
  setOrder(data:{
    payment_type: string,
    items: any
  }): Observable<any> {
    const url = API_DATA_URL+"/order";
    return this.http.post<any>(url,data).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }

}
