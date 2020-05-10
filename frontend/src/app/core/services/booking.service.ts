import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { NotificationService } from './notification.service';
import { Booking } from '../models/booking.model';

const API_DATA_URL = environment.serverUrl;
@Injectable({
  providedIn: 'root'
})
export class BookingService {

  constructor(
    private http: HttpClient,
    private notificationService: NotificationService
    ) { }


  getAllBookings(): Observable<Booking[]> {
    const url = API_DATA_URL + "/bookings"
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }

  setBookOfTableById(id: number,data:{
    book_date: string,
    book_time: string,
    people_count: number
  }): Observable<any> {
    const url = API_DATA_URL + "/book/table/" + id;
    return this.http.post<any>(url,data).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }

}
