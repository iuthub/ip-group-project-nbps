import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { ToastrService } from 'ngx-toastr';
import { empty, Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';

const API_DATA_URL = environment.serverUrl;

enum paymentType{cash,card}

@Injectable({
  providedIn: 'root'
})
export class OrderService {

  constructor(private http: HttpClient, private toastr: ToastrService) { }

  showErrorMessage(error){
    console.log(error);
    this.toastr.error("Something went wrong.");
    return empty();
  }

  getAllOrders(): Observable<any> {
    const url = API_DATA_URL+"/orders"
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }
  getOrderById(id:number): Observable<any> {
    const url = API_DATA_URL+"/order/"+id;
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }
  setOrder(data:{
    payment_type: paymentType,
    items: Array<any>

  }): Observable<any> {
    const url = API_DATA_URL+"/order";
    return this.http.post<any>(url,data).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }

}
