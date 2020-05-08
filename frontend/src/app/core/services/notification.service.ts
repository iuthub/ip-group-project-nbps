import { Injectable } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { empty } from 'rxjs';




@Injectable({
  providedIn: 'root'
})
export class NotificationService {

  constructor(private toastr: ToastrService){}

  showError({ error }) {
    const errorMsg = error.errors ? error.errors[0]  : error.message;
    this.toastr.error(errorMsg);
    return empty();
  };
}