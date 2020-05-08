import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SharedModule } from './components/shared/shared.module';
import { IndexComponent } from './pages/index/index.component';
import { ErrorComponent } from './pages/error/error.component';
import { MenuComponent } from './pages/menu/menu.component';
import { ContactsComponent } from './pages/contacts/contacts.component';
import { AboutComponent } from './pages/about/about.component';
import { TablesComponent } from './pages/tables/tables.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

//Toastr
import { ToastrModule } from 'ngx-toastr';


//Swiper
import { SwiperModule } from 'ngx-swiper-wrapper';
import { SWIPER_CONFIG } from 'ngx-swiper-wrapper';
import { SwiperConfigInterface } from 'ngx-swiper-wrapper';

// Modal
import { ModalModule } from 'ngx-bootstrap/modal';

// DatePicker
import { BsDatepickerModule } from 'ngx-bootstrap/datepicker';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';


const DEFAULT_SWIPER_CONFIG: SwiperConfigInterface = {
  slidesPerView: 1,
  spaceBetween: 40,
  speed: 500, 
};

@NgModule({
  declarations: [
    AppComponent,
    IndexComponent,
    ErrorComponent,
    MenuComponent,
    ContactsComponent,
    TablesComponent,
    AboutComponent,
    LoginComponent,
    RegisterComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule, 
    SharedModule, 
    BrowserAnimationsModule,
    SwiperModule,
    ModalModule.forRoot(),
    BsDatepickerModule.forRoot(),
    FontAwesomeModule,
    ToastrModule.forRoot(),
  ],
  providers: [
    {
      provide: SWIPER_CONFIG,
      useValue: DEFAULT_SWIPER_CONFIG
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
