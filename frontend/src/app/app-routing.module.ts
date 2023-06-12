import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from '@app/features/dashboard/dashboard.component';
import { FormComponent } from '@app/features/form/form.component';
import { NewFormComponent } from '@app/features/new-form/new-form.component';

const routes: Routes = [
  { path: '', redirectTo: 'dashboard', pathMatch: 'full' },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'forms/:formId/new', component: NewFormComponent },
  { path: 'forms/:formId/:mode/:entryId', component: FormComponent },

  // Otherwhise redirect to home
  { path: '**', redirectTo: 'dashboard' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
