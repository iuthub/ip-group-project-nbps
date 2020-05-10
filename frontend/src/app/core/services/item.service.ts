import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Category } from '../models/category.model';
import { NotificationService } from './notification.service';

const API_DATA_URL = environment.serverUrl;

@Injectable({
  providedIn: 'root'
})

export class ItemService {

  constructor(private http: HttpClient, private notificationService: NotificationService) { }

  search(title: string): Observable<any> {
    const url = API_DATA_URL + "/items/search";
    let params = new HttpParams();
    params = params.append('title', title);
    return this.http.get<any>(url, {
      params: params
    }).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }

}
