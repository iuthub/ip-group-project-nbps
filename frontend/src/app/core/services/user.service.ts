import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

import { environment } from '../../../environments/environment';
import { Observable, of, empty } from 'rxjs';
import { catchError, mergeMap } from 'rxjs/operators';

import { ToastrService } from 'ngx-toastr';
import { Profile } from '../models/profile.model';


const API_DATA_URL = environment.serverUrl;

@Injectable({
  providedIn: "root"
})
export class UserService {

  constructor(private http: HttpClient, private toastr: ToastrService) {
  }

  showErrorMessage(error) {
    console.log(error);
    this.toastr.error("Something went wrong.");
    return empty();
  }

  login(data: {
    email: string,
    password: string
  }): Observable<any> {
    const url = API_DATA_URL+"/login";

    return this.http.post<any>(url, data).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  };

  signup(data: Profile): Observable<any> {
    const url = API_DATA_URL+"/signup" 
    
    
    return this.http.post<any>(url, data).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }
  
  refresh(): Observable<any>{
    const url = API_DATA_URL+"/refresh" 
    return this.http.post<any>(url, {}).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }
  
  logout(): Observable<any>{
    const url = API_DATA_URL+"/logout" 
    return this.http.post<any>(url, {}).pipe(
      catchError(error => this.showErrorMessage(error))
    );
  }





}