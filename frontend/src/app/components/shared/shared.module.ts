import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { RouterModule } from "@angular/router";
import { ItemCardComponent } from './item-card/item-card.component';

@NgModule({
  declarations: [
    HeaderComponent,
    FooterComponent,
    ItemCardComponent
  ],
  imports: [
    CommonModule, 
    RouterModule
  ],
  exports: [
    HeaderComponent, 
    FooterComponent,
    ItemCardComponent
  ],
})

export class SharedModule { }
