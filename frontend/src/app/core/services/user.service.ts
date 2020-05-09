import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from '../../../environments/environment';
import { Observable, Subject } from 'rxjs';
import { catchError } from 'rxjs/operators';

import { Profile } from '../models/profile.model';
import { NotificationService } from './notification.service';
import { User } from '../models/user.model';


const API_DATA_URL = environment.serverUrl;

@Injectable({
  providedIn: 'root'
})
export class UserService {
  //Status of auth changed event
  authChange = new Subject<void>();
  


  constructor(private http: HttpClient, private notificationService: NotificationService) {
  }



  login(data: {
    email: string,
    password: string
  }): Observable<any> {
    const url = API_DATA_URL+"/login";

    return this.http.post<any>(url, data).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  };

  signup(data: Profile): Observable<any> {
    const url = API_DATA_URL+"/signup" 
    
    
    return this.http.post<any>(url, data).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }
  
  refresh(): Observable<any>{
    const url = API_DATA_URL+"/refresh" 
    return this.http.post<any>(url, {}).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }
  
  logout(): Observable<any>{
    const url = API_DATA_URL+"/logout" 
    return this.http.post<any>(url, {}).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }
  
  getAccessToken():string|boolean {
    let authorization = window.localStorage.getItem('authorization');
    if (authorization) {
      return JSON.parse(authorization).token;
    } else {
      return false;
    }
  }
  
  isAuthenticated(): boolean {
    const authorization = window.localStorage.getItem('authorization');
    if (authorization) {
      const authorizationObj = JSON.parse(authorization);
      return new Date().getTime() < authorizationObj.expiryDate
    }
    return false;
  }

  
  getUserInfo() : Observable<User> {
    const url = API_DATA_URL+"/account" 
    return this.http.get<User>(url).pipe(
      catchError(error => this.notificationService.showError(error))
    );
  }
  
  

  



}