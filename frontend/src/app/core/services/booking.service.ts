import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { ToastrService } from 'ngx-toastr';
import { empty, Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';

const API_DATA_URL = environment.serverUrl;
@Injectable({
  providedIn: 'root'
})
export class BookingService {

  constructor(private http: HttpClient, private toastr: ToastrService) { }

  showErrorMessage(error) {
    console.log(error);
    this.toastr.error("Something went wrong.");
    return empty();
  }

  getAllBookings(): Observable<any> {
    const url = API_DATA_URL + "/bookings"
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }

  setBookOfTableById(id: number): Observable<any> {
    const url = API_DATA_URL + "/book/table/" + id;
    return this.http.post<any>(url,{}).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }

}
