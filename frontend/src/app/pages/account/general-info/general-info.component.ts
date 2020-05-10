import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/core/services/user.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Profile } from 'src/app/core/models/profile.model';
import { User } from 'src/app/core/models/user.model';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { OrderService } from 'src/app/core/services/order.service';

@Component({
  selector: 'app-general-info',
  templateUrl: './general-info.component.html',
  styleUrls: ['./general-info.component.scss']
})
export class GeneralInfoComponent implements OnInit {

  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();

  constructor(
    private userService: UserService,
    private fb: FormBuilder,
  ) { };
  
  
  accountInfo : any;
  
  isLoading = true;
  isEdit = false;
  form: FormGroup;
  isFormReady = false;
 
  
  ngOnInit(): void {
    this.userService.getUserInfo().pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.accountInfo = res;
        this.isLoading = false;
      })

  }
  
  
  ngOnDestroy() {
    this.destroy.next();
    this.destroy.complete();
  }

  createForm() {

    this.form = this.fb.group({
      name: ["", Validators.compose([Validators.minLength(5), Validators.required])],
      email: ["", Validators.compose([Validators.email, Validators.required])],
      password: ["", Validators.compose([Validators.minLength(5), Validators.required])],
      firstname: ["", Validators.compose([Validators.minLength(5), Validators.required])],
      lastname: ["", Validators.compose([Validators.minLength(5), Validators.required])]
    });


    this.isFormReady = true;
  }

  edit(){

  }

}
