// Angular
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { GeneralInfoComponent } from './general-info/general-info.component';
import { UserOrdersComponent } from './user-orders/user-orders.component';
import { AccountComponent } from './account.component';

const routes: Routes = [
  {
    path: '',
		component: AccountComponent,
    children: [
      {
        path: '',
        component: UserOrdersComponent,
        pathMatch: "full",
      },
      {
        path: 'info',
        component: GeneralInfoComponent,
      },
    ]
  },
  { path: '**', redirectTo: '/404' },
];

@NgModule({
  imports: [
    RouterModule.forChild(routes)
  ],
  exports: [RouterModule]
})
export class AccountRoutingModule {
}
