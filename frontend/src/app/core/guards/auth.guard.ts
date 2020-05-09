// Angular
import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
// RxJS
import { Observable } from 'rxjs';
import { UserService } from '../services/user.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(private userService: UserService, private router: Router) { }

  canActivate(): any {
    return this.userService.isAuthenticated() || this.router.navigateByUrl('/login');
  }
}
