import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AccountComponent } from './account.component';
import { GeneralInfoComponent } from './general-info/general-info.component';
import { UserOrdersComponent } from './user-orders/user-orders.component';
import { AccountRoutingModule } from './account.routing';



@NgModule({
  declarations: [AccountComponent, GeneralInfoComponent, UserOrdersComponent],
  imports: [
    CommonModule, 
    AccountRoutingModule, 
  ]
})
export class AccountModule { }
