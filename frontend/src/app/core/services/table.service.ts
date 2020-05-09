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
export class TableService {

  constructor(private http: HttpClient, private toastr: ToastrService) { }
  
  showErrorMessage(error) {
    console.log(error);
    this.toastr.error("Something went wrong.");
    return empty();
  }

  getAllTables(): Observable<any> {
    const url = API_DATA_URL + "/tables"
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }

  getBookingOfTableById(id: number): Observable<any> {
    const url = API_DATA_URL + "/table/" + id + "/details"
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }

  

}
