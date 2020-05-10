import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { NotificationService } from './notification.service';
import { Table } from '../models/table.model';
import { Time } from '@angular/common';

const API_DATA_URL = environment.serverUrl;
@Injectable({
  providedIn: 'root'
})
export class TableService {

  constructor(
    private http: HttpClient,
    private notificationService: NotificationService
  ) { }


  getAllTables(): Observable<{ tables: Table[] }> {
    const url = API_DATA_URL + "/tables"
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }

  getBookingOfTableById(id: number): Observable<Table> {
    const url = API_DATA_URL + "/table/" + id + "/details"
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }

  getTableStatus(id: number,data): Observable<any> {
    const url = API_DATA_URL + "/table/" + id + "/status"
    return this.http.get<any>(url, data).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }



}
