import { createRouter, createWebHashHistory } from 'vue-router'
import LoginView from '@/views/LoginView.vue'
import HomeView from '@/views/HomeView.vue'
import ChangePasswordView from '@/views/ChangePasswordView.vue'
import SeatSelectionView from '@/views/SeatSelectionView.vue'
import ConfirmOrderView from '@/views/ConfirmOrderView.vue'
import DetailTransactionView from '@/views/DetailTransactionView.vue'
import TransactionHistoryView from '@/views/TransactionHistoryView.vue'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/change-password',
    name: 'changePassword',
    component: ChangePasswordView
  },
  {
    path: '/seat-selection',
    name: 'seatSelection',
    component: SeatSelectionView,
  },
  {
    path: '/confirm-order',
    name: 'confirmOrder',
    component: ConfirmOrderView
  },
  {
    path: '/detail-transaction',
    name: 'detailTransaction',
    component: DetailTransactionView,
    meta: {
      reload: true,
    }
  },
  {
    path: '/transaction-history',
    name: 'transactionHistory',
    component: TransactionHistoryView
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
