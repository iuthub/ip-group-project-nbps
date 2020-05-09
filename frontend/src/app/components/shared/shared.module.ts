import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { RouterModule } from "@angular/router";
import { ItemCardComponent } from './item-card/item-card.component';
import { LoadingComponent } from './loading/loading.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';

@NgModule({
  declarations: [
    HeaderComponent,
    FooterComponent,
    ItemCardComponent,
    LoadingComponent
  ],
  imports: [
    CommonModule, 
    RouterModule,
    FontAwesomeModule,
  ],
  exports: [
    HeaderComponent, 
    FooterComponent,
    ItemCardComponent, 
    LoadingComponent
  ],
})

export class SharedModule { }
