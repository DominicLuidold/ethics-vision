import localeDe from '@angular/common/locales/de';
import { LOCALE_ID, NgModule } from '@angular/core';

import { registerLocaleData } from '@angular/common';
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { DashboardComponent } from './features/dashboard/dashboard.component';
import { FormComponent } from './features/form/form.component';
import { NewFormComponent } from './features/new-form/new-form.component';
import { ErrorInterceptor } from './shared/interceptors/error.interceptor';
import { SharedModule } from './shared/shared.module';

registerLocaleData(localeDe);

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    NewFormComponent,
    FormComponent,
  ],
  imports: [
    AppRoutingModule,
    BrowserModule,
    BrowserAnimationsModule,
    HttpClientModule,
    SharedModule,
  ],
  providers: [
    { provide: LOCALE_ID, useValue: 'de-AT' },
    { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
