import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { IndexComponent } from './pages/index/index.component';
import { ErrorComponent } from './pages/error/error.component';
import { MenuComponent } from './pages/menu/menu.component';
import { ContactsComponent } from './pages/contacts/contacts.component';
import { TablesComponent } from './pages/tables/tables.component';


const routes: Routes = [
  { path: '', component: IndexComponent, pathMatch: 'full' },
  { path: 'menu', component: MenuComponent },
  { path: 'contacts', component: ContactsComponent },
  { path: 'tables', component: TablesComponent },
  { path: '**', component: ErrorComponent },  // Wildcard route for a 404 page
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
