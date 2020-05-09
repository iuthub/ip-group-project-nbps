import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Category } from '../models/category.model';
import { NotificationService } from './notification.service';

const API_DATA_URL = environment.serverUrl;

@Injectable({
  providedIn: 'root'
})


export class CategoryService {

  constructor(private http: HttpClient, private notificationService: NotificationService) { }


  getAllCategories(): Observable<Category[]> {
    const url = API_DATA_URL+"/categories"
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }
  getCategoryById(id: number): Observable<Category> {
    const url = API_DATA_URL+"/category/"+id;
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
      
    );
  }
  getItemsByCategoryId(id: number): Observable<any> {
    const url = API_DATA_URL+"/category/"+id+"/items";
    return this.http.get<any>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }


}
