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


export class CategoryService {

  constructor(private http: HttpClient, private toastr: ToastrService) { }

  showErrorMessage(error){
    console.log(error);
    this.toastr.error("Something went wrong.");
    return empty();
  }

  getAllCategories(): Observable<any> {
    const url = API_DATA_URL+"/categories"
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }
  getCategoryById(id: number): Observable<any> {
    const url = API_DATA_URL+"/category/"+id;
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }
  getItemsByCategoryId(id: number): Observable<any> {
    const url = API_DATA_URL+"/category/"+id+"/items";
    return this.http.get<any>(url).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }


}
